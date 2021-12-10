<?php

namespace Riclep\SocialGraces\Tests\Fixtures;

use Riclep\SocialGraces\Manner;

class TestSocialGrace extends \Riclep\SocialGraces\SocialGrace
{
	protected $source = 'https://example.com';

	protected $manners = [
		'facebook' => TestManner::class,
		'twitter' => TwitterManner::class,
	];
}