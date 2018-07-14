<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\PaypalGateway
*/

namespace Duopay\Provider\Gateway;

use Duopay\Contract\DuopayProviderContract;
use Duopay\Contract\DuopayProviderGatewayContract;

class PaypalGateway implements DuopayProviderGatewayContract
{
	
	/**
	* {@inheritDoc}
	*/
	public function __construct(DuopayProviderContract $provider)
	{
		//
	}

}