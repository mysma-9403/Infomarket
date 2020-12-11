<?php

namespace AppBundle\Factory\Item\Other;

use AppBundle\Entity\Other\ProductValue;
use AppBundle\Factory\Item\Base\ItemFactory;

class ProductValueFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(ProductValue::class);
	}
}