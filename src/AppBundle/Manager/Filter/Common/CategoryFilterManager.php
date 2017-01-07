<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class CategoryFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$branchRepository = $this->doctrine->getRepository(Branch::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		
		return new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
	}
}