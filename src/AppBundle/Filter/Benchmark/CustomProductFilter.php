<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class CustomProductFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @var integer
	 */
	protected $contextUser = null;
	
	/**
	 *
	 * @var array
	 */
	protected $brands = array();
	
	/**
	 *
	 * @var array
	 */
	protected $categories = array();
	
	public function initRequestValues(Request $request) {	
		parent::initRequestValues($request);
		
		$this->brands = $this->getRequestArray($request, 'brands');
		$this->categories = $this->getRequestArray($request, 'categories');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->brands = array();
		$this->categories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'brands', $this->brands);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}
	
	/**
	 * Set contextUser
	 *
	 * @param string $contextUser
	 *
	 * @return ContextUserFilter
	 */
	public function setContextUser($contextUser)
	{
		$this->contextUser = $contextUser;
	
		return $this;
	}
	
	/**
	 * Get contextUser
	 *
	 * @return string
	 */
	public function getContextUser()
	{
		return $this->contextUser;
	}
	
	/**
	 * Set brands
	 *
	 * @param array $brands
	 *
	 * @return ProductFilter
	 */
	public function setBrands($brands)
	{
		$this->brands = $brands;
	
		return $this;
	}
	
	/**
	 * Get term brands
	 *
	 * @return array
	 */
	public function getBrands()
	{
		return $this->brands;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return ProductFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get term categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}