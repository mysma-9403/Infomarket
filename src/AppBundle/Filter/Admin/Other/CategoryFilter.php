<?php

namespace AppBundle\Filter\Admin\Other;

use AppBundle;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class CategoryFilter extends Filter {
	
	/**
	 *
	 * @var integer
	 */
	protected $category = null;
	
	
	public function initRequestValues(Request $request) {	
		$this->category = $this->getRequestValue($request, 'category');
	}
	
	public function clearRequestValues() {
		$this->category = null;
	}
	
	public function getRequestValues() {
		$values = array();
	
		$this->setRequestValue($values, 'category', $this->category);
		
		return $values;
	}
	
	/**
	 * Set category
	 *
	 * @param integer $category
	 *
	 * @return CategoryFilter
	 */
	public function setCategory($category)
	{
		$this->category = $category;
	
		return $this;
	}
	
	/**
	 * Get term category
	 *
	 * @return integer
	 */
	public function getCategory()
	{
		return $this->category;
	}
}