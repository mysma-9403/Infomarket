<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\AdvertCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class AdvertCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(AdvertCategoryAssignment::class);
	}
}