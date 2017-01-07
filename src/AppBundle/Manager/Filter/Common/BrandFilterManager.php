<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\BrandFilter;
use AppBundle\Entity\Segment;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class BrandFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
    	$segmentRepository = $this->doctrine->getRepository(Segment::class);
    	 
    	return new BrandFilter($userRepository, $categoryRepository, $segmentRepository);
	}
}