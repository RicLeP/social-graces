<?php

namespace Riclep\SocialGraces\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{

	public function setUp(): void
	{
		$this->emptyTempDirectory();

		parent::setUp();
	}

	/**
	 * Define environment setup.
	 *
	 * @param  \Illuminate\Foundation\Application  $app
	 * @return void
	 */
	protected function getEnvironmentSetUp($app)
	{
		$app['config']->set('socialgraces.chromium_arguments', ['no-sandbox']);
		$app['config']->set('socialgraces.save_path', __DIR__.'/temp');
		$app['config']->set('socialgraces.public_path', 'storage/');
	}

	protected function emptyTempDirectory()
	{
		$tempDirPath = __DIR__.'/temp';

		$files = scandir($tempDirPath);

		foreach ($files as $file) {
			if (! in_array($file, ['.', '..', '.gitignore'])) {
				unlink("{$tempDirPath}/{$file}");
			}
		}
	}
}