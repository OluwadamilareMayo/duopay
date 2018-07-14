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
	* @link 	https://developer.paypal.com/docs/api/overview/#make-your-first-call
	* @access 	public
	* @return 	Mixed
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

}