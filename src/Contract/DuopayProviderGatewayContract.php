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

}