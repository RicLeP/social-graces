<?php

namespace Riclep\SocialGraces\Tests;

use Riclep\SocialGraces\Manner;

class SocialGracesTest extends TestCase
{

	/** @test */
	public function can_run_a_manner()
	{
		$manner = new Manner();
		dd($manner->run());
		$this->assertEquals(1, 1);
	}
}