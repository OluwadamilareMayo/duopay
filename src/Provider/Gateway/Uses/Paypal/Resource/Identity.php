<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\Uses\PayPal\Resource\Identity
*/

namespace Duopay\Provider\Gateway\Uses\PayPal\Resource;

use Duopay\Http\Response;
use Duopay\Provider\Gateway\Uses\PayPal\EndPoint;

trait Identity
{

	/**
	* Makes a request that returns the user information.
	*
	* @param 	$accessToken String
	* @access 	public
	* @return 	Object Duopay\Http\Response
	* @link 	https://developer.paypal.com/docs/api/identity/v1/#openidconnect_userinfo
	*/
	public function getIdentity(String $accessToken)
	{
		$request = $this->makeRequestEndPointWithClient(EndPoint::GET_IDENTITY);
		$request->setHeader('Authorization', 'Bearer ' . $accessToken);
		$response = $request->get();

		return new Response($response);
	}

}