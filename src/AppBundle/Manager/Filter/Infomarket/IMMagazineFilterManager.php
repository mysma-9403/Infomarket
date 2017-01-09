<?php

namespace AppBundle\Manager\Filter\Infomarket;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Manager\Filter\Common\MagazineFilterManager;

class IMMagazineFilterManager extends MagazineFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var MagazineFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$filter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
		$filter->setMain(BaseEntityFilter::TRUE_VALUES);
		$filter->setOrderBy('e.orderNumber ASC, e.name DESC');
		
		return $filter;
	}
}