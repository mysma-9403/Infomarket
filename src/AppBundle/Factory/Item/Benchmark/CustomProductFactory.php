<?php

namespace AppBundle\Factory\Item\Benchmark;

use AppBundle\Entity\Main\Product;
use AppBundle\Factory\Item\Base\ItemFactory;

class CustomProductFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Product::class);
	}
	
	public function create() {
		$item = parent::create();
		
		/** @var Product $item */
		$item->setCustom(true);
		
		return $item;
	}
}