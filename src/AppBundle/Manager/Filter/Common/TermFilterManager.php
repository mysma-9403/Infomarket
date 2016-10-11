<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\TermFilter;
use AppBundle\Entity\Segment;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class TermFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
    	$brandRepository = $this->doctrine->getRepository(Brand::class);
    	$segmentRepository = $this->doctrine->getRepository(Segment::class);
    	
    	return new TermFilter($userRepository, $categoryRepository, $brandRepository, $segmentRepository);
	}
}