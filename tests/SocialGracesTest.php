<?php

namespace Riclep\SocialGraces\Tests;

use Riclep\SocialGraces\Tests\Fixtures\NetworkGrace;
use Riclep\SocialGraces\Tests\Fixtures\ExampleJpgManner;
use Riclep\SocialGraces\Tests\Fixtures\ExampleManner;
use Riclep\SocialGraces\Tests\Fixtures\TestGrace;

class SocialGracesTest extends TestCase
{

	/** @test */
	public function can_run_a_manner()
	{
		$manner = new ExampleManner();
		$manner->run();
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/') . '.png');
	}

	/** @test */
	public function can_size_an_image_in_manner()
	{
		$manner = new ExampleManner();
		$manner->run();

		$imageSize = getimagesize(config('social_graces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/') . '.png');

		$this->assertEquals(1200, $imageSize[0]);
		$this->assertEquals(630, $imageSize[1]);
	}

	/** @test */
	public function can_size_an_image_with_method()
	{
		$manner = new ExampleManner();
		$manner->width(500)->height(200)->run();

		$imageSize = getimagesize(config('social_graces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/') . '.png');

		$this->assertEquals(500, $imageSize[0]);
		$this->assertEquals(200, $imageSize[1]);
	}

	/** @test */
	public function can_set_image_format_in_manner()
	{
		$manner = new ExampleJpgManner();
		$manner->run();
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . 'example.jpg');
	}

	/** @test */
	public function can_set_filename()
	{
		$manner = new ExampleJpgManner();
		$manner->filename('hello.jpg')->run();
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . 'hello.jpg');
	}

	/** @test */
	public function can_set_image_format_with_method()
	{
		$manner = new ExampleManner();
		$manner->format('jpg')->run();
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/') . '.jpg');
	}

	/** @test */
	public function can_get_manner_url()
	{
		$manner = new ExampleManner();
		$manner->run();

		$this->assertEquals('http://localhost/storage/592c092713d6e8a91c1d01831f82c228.png', $manner->url());
	}

	/** @test */
	public function can_set_manner_source()
	{
		$manner = new ExampleManner();
		$manner->source('https://example.com')->run();

		$this->assertEquals('http://localhost/storage/c984d06aafbecf6bc55569f964148ea3.png', $manner->url());
	}

	/** @test */
	public function can_run_manners_in_grace()
	{
		$grace = new NetworkGrace();
		$grace->goodManners();

		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . 'facebook.png');
		$this->assertFileExists(config('social_graces.save_path') . DIRECTORY_SEPARATOR . 'twitter.jpg');
	}

	/** @xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxtest */
	public function can_get_a_manner()
	{
		$grace = new NetworkGrace();
		$demeanour = $grace->manner('facebook');
	}

	/** @test */
	public function can_get_a_manner_url()
	{
		$grace = new TestGrace();

		// example.com png
		$url = $grace->manner('facebook')->url();
		$this->assertEquals('http://localhost/storage/c984d06aafbecf6bc55569f964148ea3.png', $url);

		$url = $grace->manner('twitter')->url();
		$this->assertEquals('http://localhost/storage/twitter.jpg', $url);
	}
}