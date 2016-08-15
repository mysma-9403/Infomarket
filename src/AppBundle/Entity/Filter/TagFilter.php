<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;

class TermFilter extends SimpleEntityFilter {

	/**
	 * 
	 */
	public function __construct() {
		parent::__construct();
		
		$this->filterName = 'tag_filter_';
	}
}