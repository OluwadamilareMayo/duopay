<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\Uses\PayPal\Resource\Payment
*/

namespace Duopay\Provider\Gateway\Uses\PayPal\Resource;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\ItemList;
use Duopay\Http\Response;
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

			$itemlist->addItem($item);
		}

		pre($itemlist);

	}

}