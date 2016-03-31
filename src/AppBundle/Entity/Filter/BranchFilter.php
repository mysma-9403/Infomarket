<?php

namespace AppBundle\Entity\Filter;

use AppBundle;
use AppBundle\Entity\Filter\Base\ImageEntityFilter;

class BranchFilter extends ImageEntityFilter {
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return 'ORDER BY e.id ASC';
	}
	
}