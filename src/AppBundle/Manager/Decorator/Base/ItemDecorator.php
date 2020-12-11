<?php

namespace AppBundle\Manager\Decorator\Base;

class ItemDecorator {
	
	/**
	 * Prepare item before update (e.g. set some read flags).
	 * @param mixed $item
	 */
	public function getPrepared($item) {
		return $item;
	}
}