<?php

namespace AppBundle\Manager\Entity\Benchmark;

// TODO deprecated - replace Managers with Factories
class CustomProductManager extends ProductManager {

	protected function create() {
		$item = parent::create();
		
		/** @var Product $item */
		$item->setCustom(true);
		
		return $item;
	}
}