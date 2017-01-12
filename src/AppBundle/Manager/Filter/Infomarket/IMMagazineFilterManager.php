<?php

namespace AppBundle\Manager\Filter\Infomarket;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Manager\Filter\Common\MagazineFilterManager;

class IMMagazineFilterManager extends MagazineFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var MagazineFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$viewParams = $params['viewParams'];
		$branch = $viewParams['branch'];
		
		$filter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
		$filter->setBranches([$branch]);
		$filter->setMain(BaseEntityFilter::TRUE_VALUES);
		$filter->setOrderBy('e.orderNumber ASC, e.name DESC');
		
		return $filter;
	}
}