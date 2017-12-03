<?php

namespace AppBundle\Manager\Decorator\Benchmark;

use AppBundle\Manager\Decorator\Base\ItemDecorator;
use AppBundle\Entity\Main\Product;

class CustomProductDecorator extends ItemDecorator {
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Manager\Decorator\Base\ItemDecorator::getPrepared()
	 * 
	 * @param Product $item
	 */
	public function getPrepared($item) {
		$item->setCustom(true);
		
		return $item;
	}
}