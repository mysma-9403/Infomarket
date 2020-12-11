<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Brand;
use AppBundle\Factory\Item\Base\ItemFactory;

class BrandFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Brand::class);
	}
}