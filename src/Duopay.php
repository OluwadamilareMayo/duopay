<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Duopay
*/

namespace Duopay;

use ReflectionClass;
use Duopay\Traits\CanMakeOption;
use Duopay\Exceptions\InvalidApiException;
use Duopay\Contract\DuopayProviderContract;
use Duopay\Exceptions\ConfigNotFoundException;
use Duopay\Exceptions\ProviderNotFoundException;
use Duopay\Contract\DuopayProviderGatewayContract;

class Duopay
{

	use CanMakeOption;

	/**
	* @var 		$gateway
	* @access 	protected
	*/
	protected 	$gateway = null;

	/**
	* @var 		$config
	* @access 	protected
	*/
	protected 	$config = [];
	
	/**
	* Duopay construct.
	*
	* @access 	public
	* @return 	Void
	*/
	public function __construct()
	{
		$this->bindConfig();
	}

	/**
	* Returns payment gateway to use.
	*
	* @param 	$gateway String
	* @access 	public
	* @return 	Duopay\Contract\DuopayProviderGatewayContract
	* @throws 	InvalidApiException | ProviderNotFoundException
	*/
	public function gateway(String $gateway = null) : DuopayProviderGatewayContract
	{
		if (!isset($this->config[$gateway])) {
			throw new InvalidApiException(
				sprintf(
					'[%s] gateway is not available.',
					$gateway
				)
			);
		}

		$provider = $this->config[$gateway]['provider'];

		if (!class_exists($provider)) {
			throw new ProviderNotFoundException(
				sprintf(
					'[%s] gateway provider does not exist.',
					$provider
				)
			);
		}

		$providerObject = new $provider();

		if (!$providerObject instanceof DuopayProviderContract) {
			throw new InvalidApiException(
				sprintf(
					'[%s] gateway provider must implement [%s]',
					$provider,
					DuopayProviderContract::class
				)
			);
		}

		return $providerObject->provides($this);
	}

	/**
	* Binds configuration options in config.php to $config property.
	*
	* @access 	protected
	* @return 	Void
	*/
	protected function bindConfig()
	{
		$configOptions = include 'config.php'; 
		$options = [];

		foreach(array_keys($configOptions) as $key) {
			$options[$key] = $configOptions[$key];
		}

		$this->config = $options;
	}

}