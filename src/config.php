<?php

return [
	'paypal' => [
		'provider' => Duopay\Provider\Paypal::class,
		'credentials' => [
			'client_id' => null,
			'client_secret' => null
		],
		'log_file' => '/logs/paypal.log'
	],

	'stripe' => [
		'provider' => Duopay\Provider\Stripe::class
	],

	'paystack' => [
		'provider' => Duopay\Provider\Paystack::class
	]
];