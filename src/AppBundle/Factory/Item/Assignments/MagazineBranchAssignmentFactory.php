<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\MagazineBranchAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class MagazineBranchAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(MagazineBranchAssignment::class);
	}
}