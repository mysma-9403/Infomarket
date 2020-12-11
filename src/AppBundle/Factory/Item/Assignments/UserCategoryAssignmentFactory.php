<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\UserCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class UserCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(UserCategoryAssignment::class);
	}
}