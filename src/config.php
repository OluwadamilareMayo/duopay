<?php

return [
	'paypal' => [

		/*
		| -----------------------------------------------------
		| Paypal provider class. If you have a custom provider,
		| you can set it here.
		| -----------------------------------------------------
		*/

		'provider' => Duopay\Provider\Paypal::class,

		/*
		| ---------------------------------------------------------
		| Paypal credentials containing client_id and client_secret
		| ---------------------------------------------------------
		*/

		'credentials' => [
			'client_id' => null,
			'client_secret' => null
		],

		/*
		| --------------------------------------------
		| Location of file where logs will be written.
		| --------------------------------------------
		*/

		'log_file' => __DIR__ . '/logs/paypal.log',

		/*
		| ---------------------------------------------------------
		| If test_mode is true, the sandbox endpoint will be used.
		| If set to false, live endpoint will be used for requests.
		| ---------------------------------------------------------
		*/

		'test_mode' => true,

		/*
		| ----------------------------------------------
		| Maximum number of items that can be purchased.
		| ----------------------------------------------
		*/

		'max_purchaseable_items' => 2,

		/*
		| --------------------------------------
		| Array of fields that an item will have
		| --------------------------------------
		*/
		
		'payment_fields' => [
			'name',
			'price',
			'currency',
			'sku',
			'quantity'
		],

		/*
		| ------------------------------------
		| Default currency to use for payments
		| ------------------------------------
		*/

		'default_currency' => 'USD',

		/*
		| -------------------------------------------
		| Url to redirect to on succesful transaction
		| -------------------------------------------
		*/

		'return_url' => 'http://www.example.com',

		/*
		| ----------------------------------------
		| Url to redirect to on transaction cancel
		| ----------------------------------------
		*/
		
		'cancel_url' => 'http://www.example.com',

		/*
		| ---------------------------------------------------
		| If set to true, page will redirect to approval page
		| on succesful payment creation.
		| ---------------------------------------------------
		*/

		'auto_redirect_to_payment_page' => false,

		/*
		| -----------------------------------------------
		| If set to true, paypal logging will be enabled.
		| -----------------------------------------------
		*/

		'enable_logging' => false
	],

	'stripe' => [
		'provider' => Duopay\Provider\Stripe::class
	],

	'paystack' => [
		'provider' => Duopay\Provider\Paystack::class
	]
];