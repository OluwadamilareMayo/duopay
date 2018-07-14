<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\Uses\Paypal\Requests
*/

namespace Duopay\Provider\Gateway\Uses\Paypal;

use Duopay\Exceptions\RequestFailedException;
use Duopay\Provider\Gateway\Uses\Paypal\EndPoint;

trait Requests
{
	
	/**
	* Makes a request to get access token.
	*
	* @access 	public
	* @return 	String
	* @link 	https://developer.paypal.com/docs/api/overview/#make-your-first-call
	*/
	public function getAccessToken()
	{
		$request = $this->makeRequestEndPointWithClient(EndPoint::GET_TOKEN);
		$request->setHeader('Accept', 'application/json');
		$request->setHeader('Accept-Language', 'en_US');
		$request->authorize(
			$this->provider->getOption('credentials')['client_id'],
			$this->provider->getOption('credentials')['client_secret'],
			'basic'
		);

		$request->setUrlParameters('grant_type', 'client_credentials');
		$response = $request->post();

		return $response->body();
	}

	/**
	* Makes a request that returns a list of activities.
	*
	* @param 	$accessToken String
	* @access 	public
	* @return 	Mixed
	* @link 	https://developer.paypal.com/docs/api/activities/v1/#activities
	*/
	public function getActivities(String $accessToken)
	{
		$request = $this->makeRequestEndPointWithClient(EndPoint::GET_ACTIVITIES);
		$request->setHeader('Authorization', 'Bearer ' . $accessToken);

		$response = $request->get();
		return $response->body();
	}

	/**
	* Makes a request that returns the user information.
	*
	* @param 	$accessToken String
	* @access 	public
	* @return 	Mixed
	* @link 	https://developer.paypal.com/docs/api/identity/v1/#openidconnect_userinfo
	*/
	public function getIdentity(String $accessToken)
	{
		$request = $this->makeRequestEndPointWithClient(EndPoint::GET_IDENTITY);
		$request->setHeader('Authorization', 'Bearer ' . $accessToken);
		$response = $request->get();

		return $response->body();
	}

}