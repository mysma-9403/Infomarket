<?php

namespace AppBundle\Filter\Infomarket\Base;

use AppBundle\Filter\Base\Filter;

class CategoriesDependentFilter extends Filter {

	/**
	 * 
	 * @var array
	 */
	protected $contextCategories = array();
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Filter\Base\Filter::initContextParams()
	 */
	public function initContextParams(array $contextParams) {
		$this->contextCategories = $contextParams['categories'];
	}
	
	/**
	 * @return array
	 */
	public function getContextCategories() {
		return $this->contextCategories;
	}
}