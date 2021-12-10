<?php

namespace Riclep\SocialGraces\Tests\Fixtures;

use Riclep\SocialGraces\Manner;

class NetworkGrace extends \Riclep\SocialGraces\SocialGrace
{
	protected $source = 'https://example.com';

	protected $manners = [
		'facebook' => FacebookManner::class,
		'twitter' => TwitterManner::class,
	];
}