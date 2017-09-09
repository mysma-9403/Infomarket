<?php

namespace AppBundle\Filter\Infomarket\Base;

use AppBundle\Filter\Base\Filter;

class CategoriesDependentFilter extends Filter {

	/**
	 *
	 * @var array
	 */
	protected $contextCategories = array();

	public function initContextParams(array $contextParams) {
		$this->contextCategories = $contextParams['categories'];
	}

	public function getContextCategories() {
		return $this->contextCategories;
	}
}