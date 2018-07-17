<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Http\Response
*/

namespace Duopay\Http;

use Kit\Http\Response as ClientResponse;

class Response
{

	/**
	* @var 		$response
	* @access 	protected
	*/
	protected 	$response;

	/**
	* Response constructor.
	*
	* @param 	$response Kit\Http\Response
	*/
	public function __construct(ClientResponse $response)
	{
		$this->response = $response;
	}

	/**
	* Returns response status code.
	*
	* @access 	public
	* @return 	Mixed
	*/
	public function getStatusCode()
	{
		return $this->response->statusCode();
	}

	/**
	* Returns the response body.
	*
	* @access 	public
	* @return 	Mixed
	*/
	public function getBody()
	{
		return $this->response->body();
	}

}