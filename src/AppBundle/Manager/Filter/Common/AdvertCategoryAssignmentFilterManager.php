<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\AdvertCategoryAssignmentFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class AdvertCategoryAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$advertRepository = $this->doctrine->getRepository(Advert::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
	
		return new AdvertCategoryAssignmentFilter($userRepository, $advertRepository, $categoryRepository);
	}
}