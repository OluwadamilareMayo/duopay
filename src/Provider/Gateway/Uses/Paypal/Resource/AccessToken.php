<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\Uses\PayPal\Resource\AccessToken
*/

namespace Duopay\Provider\Gateway\Uses\PayPal\Resource;

use Duopay\Http\Response;
use Duopay\Provider\Gateway\Uses\PayPal\EndPoint;

trait AccessToken
{

	/**
	* Makes a request to get access token.
	*
	* @access 	public
	* @return 	Object Duopay\Http\Response
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

		return new Response($response);
	}

}