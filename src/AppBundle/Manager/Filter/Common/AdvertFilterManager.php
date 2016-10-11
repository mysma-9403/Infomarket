<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\AdvertFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class AdvertFilterManager extends BaseFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var Advert $filter */
		$filter = parent::adaptToView($filter, $params);
	
		$filter->setOrderBy('e.createdAt DESC');
	
		return $filter;
	}
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
    	
    	return new AdvertFilter($userRepository, $categoryRepository);
	}
}