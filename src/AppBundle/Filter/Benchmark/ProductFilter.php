<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class ProductFilter extends Filter {
	
	/**
	 *
	 * @var integer
	 */
	protected $contextCategory = null;
	
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
	
	/**
	 *
	 * @var integer
	 */
	protected $minPrice;
	
	/**
	 *
	 * @var integer
	 */
	protected $maxPrice;
	
	
	public function __construct() {
		$this->filterName = 'product_';
	}
	
	public function initContextParams(array $contextParams) {
		$this->contextCategory = $contextParams['subcategory'];
	}
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->brands = $this->getRequestArray($request, 'brands');
		$this->categories = $this->getRequestArray($request, 'categories');
		
		$this->minPrice = $this->getRequestValue($request, 'min_price');
		$this->maxPrice = $this->getRequestValue($request, 'max_price');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->brands = array();
		$this->categories = array();
		
		$this->minPrice = null;
		$this->maxPrice = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'brands', $this->brands);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		$this->setRequestValue($values, 'min_price', $this->minPrice);
		$this->setRequestValue($values, 'max_price', $this->maxPrice);
		
		return $values;
	}
	
	/**
	 * Set contextCategory
	 *
	 * @param integer $contextCategory
	 *
	 * @return ProductFilter
	 */
	public function setContextCategory($contextCategory)
	{
		$this->contextCategory = $contextCategory;
	
		return $this;
	}
	
	/**
	 * Get term contextCategory
	 *
	 * @return integer
	 */
	public function getContextCategory()
	{
		return $this->contextCategory;
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
	
	/**
	 * Set minPrice
	 *
	 * @param integer $minPrice
	 *
	 * @return WasherFilter
	 */
	public function setMinPrice($minPrice)
	{
		$this->minPrice = $minPrice;
	
		return $this;
	}
	
	/**
	 * Get term minPrice
	 *
	 * @return integer
	 */
	public function getMinPrice()
	{
		return $this->minPrice;
	}
	
	/**
	 * Set maxPrice
	 *
	 * @param integer $maxPrice
	 *
	 * @return WasherFilter
	 */
	public function setMaxPrice($maxPrice)
	{
		$this->maxPrice = $maxPrice;
	
		return $this;
	}
	
	/**
	 * Get term maxPrice
	 *
	 * @return integer
	 */
	public function getMaxPrice()
	{
		return $this->maxPrice;
	}
}