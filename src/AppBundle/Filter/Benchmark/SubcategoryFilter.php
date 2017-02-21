<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class SubcategoryFilter extends Filter {
	
	/**
	 *
	 * @var integer
	 */
	protected $subcategory = null;
	
	
	public function initRequestValues(Request $request) {	
		$this->subcategory = $this->getRequestValue($request, 'subcategory');
	}
	
	public function clearRequestValues() {
		$this->subcategory = null;
	}
	
	public function getRequestValues() {
		$values = array();
	
		$this->setRequestValue($values, 'subcategory', $this->subcategory);
		
		return $values;
	}
	
	/**
	 * Set subcategory
	 *
	 * @param integer $subcategory
	 *
	 * @return CategoryFilter
	 */
	public function setSubcategory($subcategory)
	{
		$this->subcategory = $subcategory;
	
		return $this;
	}
	
	/**
	 * Get term subcategory
	 *
	 * @return integer
	 */
	public function getSubcategory()
	{
		return $this->subcategory;
	}
}