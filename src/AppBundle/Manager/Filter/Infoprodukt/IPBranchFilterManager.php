<?php

namespace AppBundle\Manager\Filter\Infoprodukt;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Manager\Filter\Common\BranchFilterManager;

class IPBranchFilterManager extends BranchFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var BranchFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$filter->setOrderBy('e.orderNumber ASC, e.name ASC');
		
		return $filter;
	}
}