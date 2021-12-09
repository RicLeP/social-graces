<?php

namespace Riclep\SocialGraces;

use Spatie\Browsershot\Browsershot;

class Manner
{
	// the definition of the image to generate

	protected $dimensions = [1200, 630];

	protected $url = 'https://example.com';

	protected $format = 'jpg';

	public function run() {
		Browsershot::url($this->url)
			->addChromiumArguments(config('social_graces.chromium_arguments'))
			->windowSize($this->dimensions[0], $this->dimensions[1])
			->save(storage_path(md5($this->url) . '.' . $this->format));
	}
}