<?php

namespace AppBundle\Manager\Filter\Infoprodukt;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Manager\Filter\Common\MagazineFilterManager;

class IPMagazineFilterManager extends MagazineFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var MagazineFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$filter->setOrderBy('e.orderNumber ASC, e.name ASC');
		
		return $filter;
	}
}