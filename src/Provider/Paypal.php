<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Paypal
*/

namespace Duopay\Provider;

use Duopay\Duopay;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Duopay\Provider\Gateway\PaypalGateway;
use Duopay\Contract\DuopayProviderContract;

class Paypal implements DuopayProviderContract
{

	/**
	* @var 		$context
	* @access 	protected
	*/
	protected 	$context;

	/**
	* {@inheritDoc}
	*/
	public function provides(Duopay $duopay)
	{
		$settings = $duopay->getOption('paypal');

		$tokenCredential = new OAuthTokenCredential(
			$settings['credentials']['client_id'],
			$settings['credentials']['client_secret']
		);

		$this->context = new ApiContext($tokenCredential);
		return new PaypalGateway($this);
	}

	/**
	* Returns provider context.
	*
	* @access 	public
	* @return 	Object
	*/
	public function getContext()
	{
		return $this->context;
	}

}