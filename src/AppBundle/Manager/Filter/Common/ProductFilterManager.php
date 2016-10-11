<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Entity\Segment;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;

class ProductFilterManager extends BaseFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var ProductFilter $filter */
		$filter = parent::adaptToView($filter, $params);
	
		$filter->setOrderBy('b.name ASC, e.name ASC');
	
		return $filter;
	}
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
    	$brandRepository = $this->doctrine->getRepository(Brand::class);
    	$segmentRepository = $this->doctrine->getRepository(Segment::class);
    	
    	return new ProductFilter($userRepository, $categoryRepository, $brandRepository, $segmentRepository);
	}
}