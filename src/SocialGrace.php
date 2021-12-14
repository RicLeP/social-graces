<?php

namespace Riclep\SocialGraces;

class SocialGrace
{
	/**
	 * @var string The source URL to be used when creating the image
	 */
	protected $source;

	/**
	 * @var boolean Whether to force overwriting the generated image
	 */
	protected $overwrite = false;

	/**
	 * Checks this SocialGrace for Manners and creates all the images.
	 * This is the perfect method to use to automate the creation of
	 * images such as when firing a publish event from your CMS
	 *
	 * @return void
	 */
	public function goodManners() {
		foreach ($this->manners as $mannerClass) {
			$manner = new $mannerClass($this);

			$manner->please($this->overwrite);
		}
	}

	/**
	 * Return a Manner by name
	 *
	 * @param $manner
	 * @return mixed
	 */
	public function manner($manner) {
		$mannerClass = $this->manners[$manner];

		return new $mannerClass($this);
	}

	/**
	 * Set the source URL for Manners in this SocialGrace
	 *
	 * @param $source
	 * @return $this
	 */
	public function source($source) {
		$this->source = $source;

		return $this;
	}

	/**
	 * Get the source URL for this grace
	 *
	 * @return mixed
	 */
	public function getSource() {
		return $this->source;
	}
}