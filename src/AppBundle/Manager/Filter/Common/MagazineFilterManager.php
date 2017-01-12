<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\Branch;

class MagazineFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	$magazineRepository = $this->doctrine->getRepository(Magazine::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
    	$branchRepository = $this->doctrine->getRepository(Branch::class);
    	
    	return new MagazineFilter($userRepository, $magazineRepository, $categoryRepository, $branchRepository);
	}
}