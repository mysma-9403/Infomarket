<?php

namespace AppBundle\Manager\Filter\Admin;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Common\CategoryFilterManager;

class ACategoryFilterManager extends CategoryFilterManager {
	
	public function adaptToTreeView(BaseEntityFilter $filter, array $params) {
		/** @var CategoryFilter $filter */
		$filter = parent::adaptToView($filter, $params);
	
		$filter->setRoot(BaseEntityFilter::TRUE_VALUES);
	
		return $filter;
	}
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$branchRepository = $this->doctrine->getRepository(Branch::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		
		return new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
	}
}