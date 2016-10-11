<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class CategoryFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$branchRepository = $this->doctrine->getRepository(Branch::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		
		return new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
	}
}