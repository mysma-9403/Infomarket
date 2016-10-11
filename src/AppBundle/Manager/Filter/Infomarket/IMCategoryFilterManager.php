<?php

namespace AppBundle\Manager\Filter\Infomarket;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Manager\Filter\Common\CategoryFilterManager;

class IMCategoryFilterManager extends CategoryFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var CategoryFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$filter->setRoot(BaseEntityFilter::TRUE_VALUES);
		$filter->setOrderBy('e.orderNumber ASC, e.name ASC');
		
		return $filter;
	}
}