<?php
/**
* @author 	Peter Taiwo
* @package 	Duopay\Provider\Gateway\Uses\Paypal\EndPoint
*/

namespace Duopay\Provider\Gateway\Uses\Paypal;

abstract class EndPoint
{

	const SANDBOX_URL 		= 'https://api.sandbox.paypal.com/';
	const LIVE_URL 			= 'https://api.paypal.com/';
	const GET_TOKEN 		= '{url}v1/oauth2/token';

}