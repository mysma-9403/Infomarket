<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\MagazineCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class MagazineCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(MagazineCategoryAssignment::class);
	}
}