<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Contract\DuopayProviderContract
*/

namespace Duopay\Contract;

use Duopay\Duopay;

interface DuopayProviderContract
{
	
	/**
	* Resolves what a provider will return.
	*
	* @param 	$duopay Duopay\Duopay
	* @access 	public
	* @return 	Object
	*/
	public function provides(Duopay $duopay);

}