<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\PayPal
*/

namespace Duopay\Provider;

use Duopay\Duopay;
use PayPal\Rest\ApiContext;
use Duopay\Traits\CanMakeOption;
use PayPal\Auth\OAuthTokenCredential;
use Duopay\Provider\Gateway\PayPalGateway;
use Duopay\Contract\DuopayProviderContract;

class PayPal implements DuopayProviderContract
{

	use CanMakeOption;

	/**
	* @var 		$context
	* @access 	protected
	*/
	protected 	$context;

	/**
	* @var 		$config
	* @access 	protected
	*/
	protected 	$config;

	/**
	* {@inheritDoc}
	*/
	public function provides(Duopay $duopay)
	{
		$this->config = $settings = $duopay->getOption('paypal');

		$tokenCredential = new OAuthTokenCredential(
			$settings['credentials']['client_id'],
			$settings['credentials']['client_secret']
		);

		$this->context = new ApiContext($tokenCredential);
		$this->context->setConfig([
			'log' => $settings['log_file'],
			'mode' => ($settings['test_mode'] == true) ? 'sandbox' : 'live'
		]);

		return new PayPalGateway($this);
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

	/**
	* Returns a configuration option;
	*
	* @param 	$key String
	* @access 	public
	* @return 	Mixed
	*/
	public function getConfigOption(String $key)
	{
		return $this->getOption($key);
	}

}