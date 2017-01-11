<?php

namespace AppBundle\Manager\Filter\Infoprodukt;

use AppBundle\Manager\Filter\Common\CategoryFilterManager;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\CategoryFilter;

class IPSearchFilterManager extends CategoryFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var CategoryFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$filter->setPreleaf(BaseEntityFilter::TRUE_VALUES);
	
		return $filter;
	}
	
	protected function create() {
		$filter = parent::create();
		
		$filter->setAddNameDecorators(true);
		$filter->setAddSubnameDecorators(true);
		$filter->setFilterName('simple_filter_');
		
		return $filter;
	}
}