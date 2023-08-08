<?php

namespace Riclep\SocialGraces;

use Illuminate\Support\Facades\Http;
use Spatie\Image\Manipulations;
use Wnx\SidecarBrowsershot\BrowsershotLambda;

abstract class Manner
{
	/**
	 * @var string The URL of a default image to use if the dynamic one can’t be created
	 */
	protected $default;

	/**
	 * @var array Width and height of the image to create
	 */
	protected $dimensions = [1500, 800];

	/**
	 * @var string The filename of the outputted image - leave blank to use a hash
	 */
	protected $filename;

	/**
	 * @var string The format of the generated image (png/jpg)
	 */
	protected $format = 'png';

	/**
	 * @var Spatie\Browsershot\Browsershot Driver to use Browsershot or BrowsershotLambda
	 */
	protected $driver = \Spatie\Browsershot\Browsershot::class;

	/**
	 * @var SocialGrace The Grace this Manner belongs to. It can be standalone.
	 */
	protected $grace;

	/**
	 * @var string The source URL to be used when creating the image, overrides the SocialGrace’s source
	 */
	protected $source;

	/**
	 * @param SocialGrace|null $grace
	 */
	public function __construct(SocialGrace $grace = null)
	{
		$this->grace = $grace;

		// if this Manner has no source use the one from the Grace
		if ($grace && !$this->source) {
			$this->source = $grace->getSource();
		}
	}

	/**
	 * Politely asks for the image to be created
	 *
	 * @param $overwrite
	 * @return $this
	 */
	public function please($overwrite = false) {
		$this->makeImage($overwrite);

		return $this;
	}

	/**
	 * Sets the width of the outputted image
	 *
	 * @param $width
	 * @return $this
	 */
	public function width($width) {
		$this->dimensions[0] = $width;

		return $this;
	}

	/**
	 * Sets the height of the outputted image
	 *
	 * @param $height
	 * @return $this
	 */
	public function height($height) {
		$this->dimensions[1] = $height;

		return $this;
	}

	/**
	 * Sets the format of the outputted image
	 *
	 * @param $format
	 * @return $this
	 */
	public function format($format) {
		$this->format = $format;

		return $this;
	}

	/**
	 * Sets the filename of the outputted image
	 *
	 * @param $filename
	 * @return $this
	 */
	public function filename($filename) {
		$this->filename = $filename;

		return $this;
	}

	/**
	 * Sets the source URL to use for the outputted image
	 *
	 * @param $source
	 * @return $this
	 */
	public function source($source) {
		$this->source = $source;

		return $this;
	}

	/**
	 * Returns the URL of the generated image
	 *
	 * @return string|null
	 */
	public function thanks() {
		$this->makeImage();

		$filename = $this->file();

		if (file_exists($this->path() . $filename)) {
			return asset(config('socialgraces.public_path') . $filename);
		}

		return $this->default ?? null;
	}

    public function htmlThanks(): string
    {
        $this->makeImage();

        $filename = $this->file();

        if (file_exists($this->path() . $filename)) {
            $url = asset(config('socialgraces.public_path') . $filename);
        } else {
            $url = $this->default ?? null;
        }

        if ($url) {
            return '<meta name="twitter:image" content="' . $url . '" >';
        }

        return '';
    }

	/**
	 * Creates the image using Browsershot
	 *
	 * @param $overwrite
	 * @return void
	 * @throws \Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot
	 */
	protected function makeImage($overwrite = false) {
		$path = $this->path();
		$filename = $this->file();

		if ($overwrite || !file_exists($path . $filename)) {
			$response = Http::get($this->source);
			if ($response->successful()) {
                BrowsershotLambda::url($this->source)
                    ->windowSize($this->dimensions[0], $this->dimensions[1])
                    ->setScreenshotType($this->format === 'jpg' ? 'jpeg' : $this->format)
                    ->save($path . $filename);
			}
		}
	}

	/**
	 * The path to the saved image
	 *
	 * @return string
	 */
	protected function path() {
		return config('socialgraces.save_path') . DIRECTORY_SEPARATOR;
	}

	/**
	 * The filename of the image
	 *
	 * @return string
	 */
	protected function file() {
		return $this->filename ?? md5($this->source) . '.' . $this->format;
	}
}
