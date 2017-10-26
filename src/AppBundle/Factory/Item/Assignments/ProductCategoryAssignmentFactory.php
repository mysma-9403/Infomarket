<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class ProductCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(ProductCategoryAssignment::class);
	}
}