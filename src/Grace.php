<?php

namespace Riclep\SocialGraces;

class Grace
{
	protected $source;

	public function goodManners() {
		foreach ($this->manners as $mannerClass) {
			$manner = new $mannerClass($this);

			$manner->run();
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