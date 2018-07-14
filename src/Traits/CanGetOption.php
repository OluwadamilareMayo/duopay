<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Traits\CanGetOption
*/

namespace Duopay\Traits;

use Duopay\Exceptions\ConfigNotFoundException;

trait CanGetOption
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
}