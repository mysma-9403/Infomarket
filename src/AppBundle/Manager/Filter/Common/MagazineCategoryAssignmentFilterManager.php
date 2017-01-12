<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\MagazineCategoryAssignmentFilter;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class MagazineCategoryAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$magazineRepository = $this->doctrine->getRepository(Magazine::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
	
		return new MagazineCategoryAssignmentFilter($userRepository, $magazineRepository, $categoryRepository);
	}
}