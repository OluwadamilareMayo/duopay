<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\PayPalGateway
*/

namespace Duopay\Provider\Gateway;

use Kit\Http\Request\RequestManager;
use Duopay\Contract\DuopayProviderContract;
use Duopay\Provider\Gateway\Uses\PayPal\EndPoint;
use Duopay\Provider\Gateway\Uses\PayPal\Requests;
use Duopay\Contract\DuopayProviderGatewayContract;
use Duopay\Provider\Gateway\Uses\PayPal\Resource\Payment;
use Duopay\Provider\Gateway\Uses\PayPal\Resource\Activity;
use Duopay\Provider\Gateway\Uses\PayPal\Resource\Identity;
use Duopay\Provider\Gateway\Uses\PayPal\Resource\AccessToken;
use Duopay\Provider\Gateway\Contract\DuopayGatewayMethodsContract;

class PayPalGateway implements DuopayProviderGatewayContract
{

	use Payment, Identity, AccessToken, Activity;
	
	/**
	* @var 		$total
	* @access 	protected
	*/
	protected 	$total;

	/**
	* @var 		$currency
	* @access 	protected
	*/
	protected 	$currency;

	/**
	* @var 		$provider
	* @access 	protected
	*/
	protected 	$provider;

	/**
	* @var 		$redirectUrl
	* @access 	protected
	*/
	protected 	$redirectUrl;

	/**
	* @var 		$cancelUrl
	* @access 	protected
	*/
	protected 	$cancelUrl;

	/**
	* @var 		$items
	* @access 	protected
	*/
	protected 	$items = [];

	/**
	* {@inheritDoc}
	*/
	public function __construct(DuopayProviderContract $provider)
	{
		$this->provider = $provider;
	}

	/**
	* Adds an item to item list.
	*
	* @param 	$item Array
	* @access 	public
	* @return 	Void
	*/
	public function enqueueItem(Array $item = [])
	{
		$this->items[] = $item;
	}

	/**
	* Sets the payment currency.
	*
	* @param 	$currency String
	* @access 	public
	* @return 	Void
	*/
	public function setCurrency(String $currency)
	{
		$this->currency = $currency;
	}

	/**
	* Sets the redirectUrl.
	*
	* @param 	$redirectUrl String
	* @access 	public
	* @return 	Void
	*/
	public function setRedirectUrl(String $redirectUrl)
	{
		$this->redirectUrl = $redirectUrl;
	}

	/**
	* Sets the cancelUrl.
	*
	* @param 	$cancelUrl String
	* @access 	public
	* @return 	Void
	*/
	public function setcancelUrl(String $cancelUrl)
	{
		$this->cancelUrl = $cancelUrl;
	}

	/**
	* Sets the total amount.
	*
	* @param 	$amount Integer
	* @access 	public
	* @return 	Void
	*/
	public function setTotal(int $amount)
	{
		$this->total = $amount;
	}

	/**
	* Returns an array of queued items.
	*
	* @access 	public
	* @return 	Array
	*/
	public function getQueuedItems() : Array
	{
		return $this->items;
	}

	/**
	* Returns maximum purchaseable items.
	*
	* @return 	Integer
	* @access 	public
	*/
	public function getMaxPurchaseableItems() : int
	{
		return $this->provider->getOption('max_purchaseable_items');
	}

	/**
	* Returns sandbox url endpoint if test_mode is true and returns live
	* url endpoint if test_mode is false.
	*
	* @param 	$with String
	* @access 	public
	* @return 	String
	*/
	public function getEndpoint(String $with = '')
	{
		if ($this->provider->getOption('test_mode') == true) {
			return EndPoint::SANDBOX_URL . $with;
		}

		return EndPoint::LIVE_URL . $with;
	}

	/**
	* Returns an array of payment fields.
	*
	* @access 	public
	* @return 	Array
	*/
	public function getPaymentFields()
	{
		return $this->provider->getOption('payment_fields');
	}

	/**
	* Resolves request end point and returns a client object.
	*
	* @param 	$with String
	* @access 	public
	* @return 	Object
	*/
	public function makeRequestEndPointWithClient(String $with = '')
	{
		$endpoint = str_replace('{url}', '', $this->getEndpoint($with));
		$request = new RequestManager($endpoint);
		$request->setHeader('Content-Type', 'application/json');

		return $request;
	}

}