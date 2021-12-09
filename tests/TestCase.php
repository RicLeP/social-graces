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
		$app['config']->set('social_graces.chromium_arguments', ['no-sandbox']);

		$app->useStoragePath(__DIR__.'/temp');

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