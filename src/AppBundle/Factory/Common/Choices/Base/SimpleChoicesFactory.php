<?php

namespace AppBundle\Factory\Common\Choices\Base;

class SimpleChoicesFactory implements ChoicesFactory {
	
	protected $items = [];
	
	public function getItems() {
		return $this->items;
	}
	
	public function getItemLabel($value) {
		return array_search($value, $this->items);
	}
}