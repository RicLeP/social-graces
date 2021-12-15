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
		$this->assertFileExists(config('socialgraces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/' . json_encode([1200, 630])) . '.png');
		// if you’re wondering, the curiosity of a child is an amazing podcast I record with my son about science, history and storytelling!
	}

	/** @test */
	public function can_size_an_image_in_manner()
	{
		$manner = new PoliteManner();
		$manner->please();

		$imageSize = getimagesize(config('socialgraces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/' . json_encode([1200, 630])) . '.png');

		$this->assertEquals(1200, $imageSize[0]);
		$this->assertEquals(630, $imageSize[1]);
	}

	/** @test */
	public function can_size_an_image_with_method()
	{
		$manner = new PoliteManner();
		$manner->width(500)->height(200)->please();

		$imageSize = getimagesize(config('socialgraces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/' . json_encode([500, 200])) . '.png');

		$this->assertEquals(500, $imageSize[0]);
		$this->assertEquals(200, $imageSize[1]);
	}

	/** @test */
	public function can_set_image_format_in_manner()
	{
		$manner = new ExampleJpgManner();
		$manner->please();
		$this->assertFileExists(config('socialgraces.save_path') . DIRECTORY_SEPARATOR . 'example.jpg');
	}

	/** @test */
	public function can_set_filename()
	{
		$manner = new ExampleJpgManner();
		$manner->filename('hello.jpg')->please();
		$this->assertFileExists(config('socialgraces.save_path') . DIRECTORY_SEPARATOR . 'hello.jpg');
	}

	/** @test */
	public function can_set_image_format_with_method()
	{
		$manner = new PoliteManner();
		$manner->format('jpg')->please();
		$this->assertFileExists(config('socialgraces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/' . json_encode([1200, 630])) . '.jpg');
	}

	/** @test */
	public function can_get_manner_url()
	{
		$manner = new PoliteManner();
		$manner->please();

		$this->assertEquals('http://localhost/storage/118cb08347f48beb239203a1b98019b6.png', $manner->thanks());
	}

	/** @test */
	public function can_set_manner_source()
	{
		$manner = new PoliteManner();
		$manner->source('https://example.com')->please();

		$this->assertEquals('http://localhost/storage/26f38783c6eba9eb0f6c2984da5a86fd.png', $manner->thanks());
	}

	/** @test */
	public function can_overwrite_a_manor_image()
	{
		$manner = new PoliteManner();
		$manner->please();
		$manner->please(true);

		$this->assertFileExists(config('socialgraces.save_path') . DIRECTORY_SEPARATOR . md5('https://thecuriosityofachild.com/' . json_encode([1200, 630])) . '.png');
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

		$this->assertFileExists(config('socialgraces.save_path') . DIRECTORY_SEPARATOR . 'facebook.png');
		$this->assertFileExists(config('socialgraces.save_path') . DIRECTORY_SEPARATOR . 'twitter.jpg');
	}

	/** @test */
	public function can_get_a_manner_url()
	{
		$grace = new TestSocialGrace();

		// example.com png
		$url = $grace->manner('facebook')->thanks();
		$this->assertEquals('http://localhost/storage/26f38783c6eba9eb0f6c2984da5a86fd.png', $url);

		// thecuriosityofachild.com jpg
		$url = $grace->manner('twitter')->thanks();
		$this->assertEquals('http://localhost/storage/twitter.jpg', $url);
	}
}