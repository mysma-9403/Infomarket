<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Product;
use AppBundle\Factory\Item\Base\ItemFactory;

class ProductFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Product::class);
	}
}