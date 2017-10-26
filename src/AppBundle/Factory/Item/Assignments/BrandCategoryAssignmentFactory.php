<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\BrandCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class BrandCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(BrandCategoryAssignment::class);
	}
}