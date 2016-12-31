<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class MagazineFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
    	
    	return new MagazineFilter($userRepository, $categoryRepository);
	}
}