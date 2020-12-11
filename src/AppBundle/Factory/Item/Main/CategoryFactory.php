<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Category;
use AppBundle\Factory\Item\Base\ItemFactory;

class CategoryFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Category::class);
	}
}