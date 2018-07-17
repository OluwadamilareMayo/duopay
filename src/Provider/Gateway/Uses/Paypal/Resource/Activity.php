<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\Uses\Paypal\Resource\Activity
*/

namespace Duopay\Provider\Gateway\Uses\Paypal\Resource;

use Duopay\Http\Response;
use Duopay\Provider\Gateway\Uses\Paypal\EndPoint;

trait Activity
{

	/**
	* Makes a request that returns a list of activities.
	*
	* @param 	$accessToken String
	* @access 	public
	* @return 	Object Duopay\Http\Response
	* @link 	https://developer.paypal.com/docs/api/activities/v1/#activities
	*/
	public function getActivities(String $accessToken)
	{
		$request = $this->makeRequestEndPointWithClient(EndPoint::GET_ACTIVITIES);
		$request->setHeader('Authorization', 'Bearer ' . $accessToken);

		$response = $request->get();
		return new Response($response);
	}

}