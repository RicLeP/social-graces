<?php

namespace Riclep\SocialGraces\Tests\Fixtures;

use Riclep\SocialGraces\Manner;

class NetworkGrace extends \Riclep\SocialGraces\Grace
{
	protected $source = 'https://example.com';

	protected $manners = [
		'facebook' => FacebookManner::class,
		'twitter' => TwitterManner::class,
	];
}