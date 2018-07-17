<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Traits\CanMakeOption
*/

namespace Duopay\Traits;

use Duopay\Exceptions\ConfigNotFoundException;

trait CanMakeOption
{
	/**
	* Returns a configuration option.
	*
	* @param 	$key String
	* @access 	public
	* @throws 	Duopay\Exceptions\ConfigNotFoundException
	*/
	public function getOption(String $key)
	{
		if (isset($this->config[$key])) {
			return $this->config[$key];
		}

		throw new ConfigNotFoundException(
			sprintf(
				'Configuration option [%s] does not exist.',
				$key
			)
		);
	}

	/**
	* Sets a configuration option.
	*
	* @param 	$key String
	* @param 	$value Mixed
	* @access 	public
	* @return 	Void
	*/
	public function setOption(String $key, $value = null)
	{
		$this->config[$key] = $value;
	}
}