<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\TermCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class TermCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(TermCategoryAssignment::class);
	}
}