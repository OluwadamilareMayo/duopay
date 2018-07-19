<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Contract\DuopayProviderGatewayContract
*/

namespace Duopay\Contract;

interface DuopayProviderGatewayContract
{

	/**
	* DuopayProviderGateway construct.
	*
	* @param 	$provider Duopay\Contract\DuopayProviderGatewayContract
	* @access 	public
	* @return 	Void
	*/
	public function __construct(DuopayProviderContract $provider);

	/**
	*  Creates a new sale payment.
	*
	* @param 	$accessToken String
	* @access 	public
	* @return 	Mixed
	*/
	public function createPayment(String $accessToken = '');

	/**
	*  Creates a new order.
	*
	* @param 	$accessToken String
	* @access 	public
	* @return 	Mixed
	*/
	public function createOrder(String $accessToken = '');

	/**
	* Executes an approved payment. Note that this might not be available for all payment
	* gateways.
	*
	* @param 	$accessToken String
	* @param 	$payerId String Id of payer.
	* @access 	public
	* @return 	Mixed
	*/
	public function executeApprovedPayment(String $accessToken = '', String $payedId = '');

}