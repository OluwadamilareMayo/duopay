<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\Uses\Paypal\Resource\Payment
*/

namespace Duopay\Provider\Gateway\Uses\Paypal\Resource;

use Duopay\Http\Response;
use Duopay\Provider\Gateway\Uses\Paypal\EndPoint;

trait Payment
{

	/**
	* Creates an authorized payment or order.
	*
	* @param 	$accessToken String
	* @access 	public
	* @return 	Object Duopay\Http\Response
	* @link 	https://developer.paypal.com/docs/api/payments/v1/#payment
	*/
	public function makePayment(String $accessToken)
	{
		$request = $this->makeRequestEndPointWithClient(EndPoint::MAKE_PAYMENT);
	}

}