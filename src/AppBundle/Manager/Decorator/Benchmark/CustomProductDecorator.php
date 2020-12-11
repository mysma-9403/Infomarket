<?php

namespace AppBundle\Manager\Decorator\Benchmark;

use AppBundle\Manager\Decorator\Base\ItemDecorator;
use AppBundle\Entity\Main\Product;
use AppBundle\Manager\Decorator\Common\Base\ImageDecorator;

class CustomProductDecorator extends ImageDecorator {
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Manager\Decorator\Base\ItemDecorator::getPrepared()
	 * 
	 * @param Product $item
	 */
	public function getPrepared($item) {
		$item->setBenchmark(true);
		$item->setCustom(true);
		
		return $item;
	}
}