<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;

class BranchFilter extends SimpleEntityFilter {
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return ' ORDER BY e.id ASC ';
	}
	
}