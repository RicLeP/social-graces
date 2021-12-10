<?php

namespace Riclep\SocialGraces;

class Grace
{
	protected $source;

	protected $overwrite = false;

	public function goodManners() {
		foreach ($this->manners as $mannerClass) {
			$manner = new $mannerClass($this);

			$manner->please($this->overwrite);
		}
	}

	public function manner($manner) {
		$mannerClass = $this->manners[$manner];

		return new $mannerClass($this);
	}

	public function source($source) {
		$this->source = $source;

		return $this;
	}

	public function getSource() {
		return $this->source;
	}
}