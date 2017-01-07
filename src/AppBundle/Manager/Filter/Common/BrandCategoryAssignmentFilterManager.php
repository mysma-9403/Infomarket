<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\BrandCategoryAssignmentFilter;
use AppBundle\Entity\Segment;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class BrandCategoryAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$brandRepository = $this->doctrine->getRepository(Brand::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		$segmentRepository = $this->doctrine->getRepository(Segment::class);
	
		return new BrandCategoryAssignmentFilter($userRepository, $brandRepository, $categoryRepository, $segmentRepository);
	}
}