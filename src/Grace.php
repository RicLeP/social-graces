<?php

namespace Riclep\SocialGraces;

class Grace
{
	protected $source;

	public function manners() {
		foreach ($this->demeanours as $demeanour) {
			$mannerClass = $demeanour['manner'];
			$manner = new $mannerClass();

			if ($this->source) {
				$manner->source($this->source);
			}

			$manner->run();
		}
	}

	public function demeanour($network) {
		return $this->demeanours[$network];
	}

	public function source($source) {
		$this->source = $source;

		return $this;
	}
}