<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\MenuEntryBranchAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class MenuEntryBranchAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(MenuEntryBranchAssignment::class);
	}
}