<?php

namespace Riclep\SocialGraces\Tests;

use Riclep\SocialGraces\Tests\Fixtures\DefaultManner;
use Riclep\SocialGraces\Tests\Fixtures\NetworkGrace;
use Riclep\SocialGraces\Tests\Fixtures\ExampleJpgManner;
use Riclep\SocialGraces\Tests\Fixtures\PoliteManner;
use Riclep\SocialGraces\Tests\Fixtures\TestSocialGrace;

class SocialGracesTest extends TestCase
{

	/** @test */
	public function can_run_a_manner()
	{
		$manner = new PoliteManner();
		$manner->please();
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/') . '.png');
		// if you’re wondering, the curiosity of a child is an amazing podcast I record with my son about science, history and storytelling!
	}

	/** @test */
	public function can_size_an_image_in_manner()
	{
		$manner = new PoliteManner();
		$manner->please();

		$imageSize = getimagesize(config('social_graces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/') . '.png');

		$this->assertEquals(1200, $imageSize[0]);
		$this->assertEquals(630, $imageSize[1]);
	}

	/** @test */
	public function can_size_an_image_with_method()
	{
		$manner = new PoliteManner();
		$manner->width(500)->height(200)->please();

		$imageSize = getimagesize(config('social_graces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/') . '.png');

		$this->assertEquals(500, $imageSize[0]);
		$this->assertEquals(200, $imageSize[1]);
	}

	/** @test */
	public function can_set_image_format_in_manner()
	{
		$manner = new ExampleJpgManner();
		$manner->please();
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . 'example.jpg');
	}

	/** @test */
	public function can_set_filename()
	{
		$manner = new ExampleJpgManner();
		$manner->filename('hello.jpg')->please();
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . 'hello.jpg');
	}

	/** @test */
	public function can_set_image_format_with_method()
	{
		$manner = new PoliteManner();
		$manner->format('jpg')->please();
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/') . '.jpg');
	}

	/** @test */
	public function can_get_manner_url()
	{
		$manner = new PoliteManner();
		$manner->please();

		$this->assertEquals('http://localhost/storage/592c092713d6e8a91c1d01831f82c228.png', $manner->thanks());
	}

	/** @test */
	public function can_set_manner_source()
	{
		$manner = new PoliteManner();
		$manner->source('https://example.com')->please();

		$this->assertEquals('http://localhost/storage/c984d06aafbecf6bc55569f964148ea3.png', $manner->thanks());
	}

	/** @test */
	public function can_overwrite_a_manor_image()
	{
		$manner = new PoliteManner();
		$manner->please();
		$manner->please(true);

		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/') . '.png');
	}

	/** @test */
	public function can_use_default_image()
	{
		$manner = new DefaultManner();

		$this->assertEquals('hello.jpg', $manner->thanks());
	}

	/** @test */
	public function can_run_manners_in_grace()
	{
		$thankYou = new NetworkGrace();
		$thankYou->goodManners();

		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . 'facebook.png');
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . 'twitter.jpg');
	}

	/** @test */
	public function can_get_a_manner_url()
	{
		$grace = new TestSocialGrace();

		// example.com png
		$url = $grace->manner('facebook')->url();
		$this->assertEquals('http://localhost/storage/c984d06aafbecf6bc55569f964148ea3.png', $url);

		// thecuriosityofachild.com jpg
		$url = $grace->manner('twitter')->url();
		$this->assertEquals('http://localhost/storage/twitter.jpg', $url);
	}
}