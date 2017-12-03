<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\MenuEntryCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class MenuEntryCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(MenuEntryCategoryAssignment::class);
	}
}