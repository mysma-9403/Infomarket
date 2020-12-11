<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\BranchCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class BranchCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(BranchCategoryAssignment::class);
	}
}