<?php

namespace Riclep\SocialGraces\Tests\Fixtures;

use Riclep\SocialGraces\Manner;

class ExampleGrace extends \Riclep\SocialGraces\Grace
{
	protected $source = 'https://example.com';

	protected $demeanours = [
		'facebook' => [
			'manner' => FacebookManner::class,
		],
		'twitter' => [
			'manner' => TwitterManner::class,
		]
	];
}