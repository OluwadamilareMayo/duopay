<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\PaypalGateway
*/

namespace Duopay\Provider\Gateway;

use PayPal\Api\Payer;
use Duopay\Contract\DuopayProviderContract;
use Duopay\Provider\Gateway\Uses\Paypal\EndPoint;
use Duopay\Contract\DuopayProviderGatewayContract;
use Duopay\Provider\Gateway\Contract\DuopayGatewayMethodsContract;

class PaypalGateway implements DuopayProviderGatewayContract
{
	
	/**
	* @var 		$amount
	* @access 	protected
	*/
	protected 	$amount;

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
	* {@inheritDoc}
	*/
	public function __construct(DuopayProviderContract $provider)
	{
		$this->provider = $provider;
	}

	/**
	* Sets the payment amount.
	*
	* @param 	$amount Integer
	* @access 	public
	* @return 	Void
	*/
	public function setAmount($amount)
	{
		$this->amount = $amount;
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
			return EndPoint::SANDBOX_URL;
		}

		return EndPoint::LIVE_URL;
	}

}