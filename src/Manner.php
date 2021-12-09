<?php

namespace Riclep\SocialGraces;

use Spatie\Browsershot\Browsershot;

class Manner
{
	protected $dimensions = [1500, 800];

	protected $filename;

	protected $format = 'png';

	public function run() {
		$path = config('social_graces.save_path') . DIRECTORY_SEPARATOR;
		$filename = $this->filename ?? md5($this->source) . '.' . $this->format;

		Browsershot::url($this->source)
			->addChromiumArguments(config('social_graces.chromium_arguments'))
			->windowSize($this->dimensions[0], $this->dimensions[1])
			->setScreenshotType($this->format === 'jpg' ? 'jpeg' : $this->format)
			->save($path . $filename);

		return $this;
	}

	public function width($width) {
		$this->dimensions[0] = $width;

		return $this;
	}

	public function height($height) {
		$this->dimensions[1] = $height;

		return $this;
	}

	public function format($format) {
		$this->format = $format;

		return $this;
	}

	public function filename($filename) {
		$this->filename = $filename;

		return $this;
	}

	public function source($source) {
		$this->source = $source;

		return $this;
	}

	public function url() {
		$filename = $this->filename ?? md5($this->source) . '.' . $this->format;
		return asset(config('social_graces.public_path') . $filename);
	}
}