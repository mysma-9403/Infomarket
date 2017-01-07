<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\BranchCategoryAssignmentFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class BranchCategoryAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$branchRepository = $this->doctrine->getRepository(Branch::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
	
		return new BranchCategoryAssignmentFilter($userRepository, $branchRepository, $categoryRepository);
	}
}