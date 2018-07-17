<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\Uses\PayPal\Resource\Payment
*/

namespace Duopay\Provider\Gateway\Uses\PayPal\Resource;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ItemList;
use Duopay\Http\Response;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use Kit\Http\Response as HttpResponse;
use PayPal\Api\Payment as PayPalPayment;
use Duopay\Provider\Gateway\Uses\PayPal\EndPoint;
use Duopay\Exceptions\InvalidItemFieldException;
use Duopay\Exceptions\InvalidItemLengthException;

trait Payment
{

	/**
	* Creates an authorized payment or order.
	*
	* @param 	$accessToken String
	* @access 	public
	* @return 	Object Duopay\Http\Response
	* @link 	https://developer.paypal.com/docs/api/payments/v1/#payment
	*/
	public function makePayment(String $accessToken)
	{
		$request = $this->makeRequestEndPointWithClient(EndPoint::MAKE_PAYMENT);
		$queuedItems = $this->getQueuedItems();
		$paymentFields = $this->getPaymentFields();

		if (sizeof($queuedItems) > $this->getMaxPurchaseableItems()) {
			throw new InvalidItemLengthException(
				sprintf(
					'You can only purchase a maximum of [%s] items.',
					$this->getMaxPurchaseableItems()
				)
			);
		}

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$itemlist = new ItemList();
		$items = [];

		foreach($queuedItems as $queuedItem) {
			$item = new Item();

			foreach($paymentFields as $paymentField) {
				if (!isset($queuedItem[$paymentField])) {
					throw new InvalidItemFieldException(
						sprintf(
							'Item does contain [%s] payment field',
							$paymentField
						)
					);
				}
				
				$itemMethod = 'set' . ucfirst($paymentField);
				$item->$itemMethod($queuedItem[$paymentField]);
			}

			$items[] = $item;
		}

		$itemlist->setItems($items);

		$details = new Details();
		$details->setShipping($this->shippingCost);
		$details->setTax($this->taxCost);
		$details->setSubtotal($this->subTotal);

		$amount = new Amount();
		$amount->setCurrency($this->currency);
		$amount->setTotal($this->total);
		$amount->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount);
		$transaction->setItemList($itemlist);
		$transaction->setDescription($this->description);
		$transaction->setInvoiceNumber($this->invoiceNumber);

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl($this->returnUrl);
		$redirectUrls->setCancelUrl($this->cancelUrl);

		$payment = new PayPalPayment();
		$payment->setIntent('sale');
		$payment->setPayer($payer);
		$payment->setRedirectUrls($redirectUrls);
		$payment->setTransactions([$transaction]);

		$request = $payment->create($this->provider->getContext());

		if (!$this->canRedirectToPaymentPage()) {
			return [
				'approval_link' => $request->getApprovalLink()
			];
		}

		$response = new HttpResponse();
		return $response->redirect(
			$request->getApprovalLink()
		);
	}

}