<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\Uses\PayPal\Resource\Uses\PaymentResponseBuilder
*/

namespace Duopay\Provider\Gateway\Uses\PayPal\Resource\Uses;

use PayPal\Api\Payment;

class PaymentResponseBuilder
{

	/**
	* @var 		$payment
	* @access 	protected
	*/
	protected 	$payment;

	/**
	* PaymentResponseBuilder construct.
	*
	* @param 	$payment PayPal\Api\Payment
	* @access 	public
	* @return 	Void
	*/
	public function __construct(Payment $payment)
	{
		$this->payment = $payment;
	}

	/**
	* Returns the approval link url.
	*
	* @access 	public
	* @return 	String
	*/
	public function getRedirectUrl()
	{
		return $this->payment->links[1]->getHref();
	}

	/**
	* Returns the execute api url.
	*
	* @access 	public
	* @return 	String
	*/
	public function getExecuteUrl()
	{
		return $this->payment->links[2]->getHref();
	}

}