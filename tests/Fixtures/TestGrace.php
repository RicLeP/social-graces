<?php

namespace Riclep\SocialGraces\Tests\Fixtures;

use Riclep\SocialGraces\Manner;

class TestGrace extends \Riclep\SocialGraces\Grace
{
	protected $source = 'https://example.com';

	protected $manners = [
		'facebook' => TestManner::class,
		'twitter' => TwitterManner::class,
	];
}