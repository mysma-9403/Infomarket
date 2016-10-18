<?php

namespace AppBundle\Manager\Filter\Infoprodukt;

use AppBundle\Manager\Filter\Common\CategoryFilterManager;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;

class IPCategoryFilterManager extends CategoryFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var \AppBundle\Entity\Filter\CategoryFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$filter->setRoot(BaseEntityFilter::TRUE_VALUES);
		
		return $filter;
	}
}