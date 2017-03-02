<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Utils\ClassUtils;
use Symfony\Component\HttpFoundation\Request;

class ProductFilter extends Filter {
	
	/**
	 * 
	 * @var BenchmarkFieldRepository
	 */
	protected $benchmarkFieldRepository;
	
	/**
	 *
	 * @var integer
	 */
	protected $contextCategory = null;
	
	/**
	 * 
	 * @var array
	 */
	protected $showFields;
	
	/**
	 *
	 * @var array
	 */
	protected $filterFields;
	
	
	
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
	
	
	public function __construct(BenchmarkFieldRepository $benchmarkFieldRepository) {
		$this->benchmarkFieldRepository = $benchmarkFieldRepository;
		
		$this->filterName = 'product_';
	}
	
	public function initContextParams(array $contextParams) {
		$this->contextCategory = $contextParams['subcategory'];
		
		$this->showFields = $this->benchmarkFieldRepository->findShowItemsByCategory($this->contextCategory);
		$this->filterFields = $this->benchmarkFieldRepository->findFilterItemsByCategory($this->contextCategory);
	}
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->brands = $this->getRequestArray($request, 'brands');
		$this->categories = $this->getRequestArray($request, 'categories');
		
		$this->minPrice = $this->getRequestValue($request, 'min_price');
		$this->maxPrice = $this->getRequestValue($request, 'max_price');
		
		foreach ($this->filterFields as $key => $field) {
			$this->filterFields[$key]['value'] = $this->getRequestString($request, ClassUtils::getCleanName($field['filterName']));
		}
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->brands = array();
		$this->categories = array();
		
		$this->minPrice = null;
		$this->maxPrice = null;
		
		foreach ($this->filterFields as $key => $field) {
			$field;
			$this->filterFields[$key]['value'] = '';
		}
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'brands', $this->brands);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		$this->setRequestValue($values, 'min_price', $this->minPrice);
		$this->setRequestValue($values, 'max_price', $this->maxPrice);
		
		foreach ($this->filterFields as $field) {
			switch($field['filterType']) {
				case BenchmarkField::SINGLE_ENUM_FILTER_TYPE:
				case BenchmarkField::MULTI_ENUM_FILTER_TYPE:
					$this->setRequestArray($values, ClassUtils::getCleanName($field['filterName']), $field['value']);
					break;
				default:
					$this->setRequestString($values, ClassUtils::getCleanName($field['filterName']), $field['value']);
					break;
			}
		}
		
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
	 * Set showFields
	 *
	 * @param array $showFields
	 *
	 * @return ProductFilter
	 */
	public function setShowFields($showFields)
	{
		$this->showFields = $showFields;
	
		return $this;
	}
	
	/**
	 * Get showFields
	 *
	 * @return array
	 */
	public function getShowFields()
	{
		return $this->showFields;
	}
	
	/**
	 * Set filterFields
	 *
	 * @param array $filterFields
	 *
	 * @return ProductFilter
	 */
	public function setFilterFields($filterFields)
	{
		$this->filterFields = $filterFields;
	
		return $this;
	}
	
	/**
	 * Get filterFields
	 *
	 * @return array
	 */
	public function getFilterFields()
	{
		return $this->filterFields;
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
	
	public function __get($valueName) {
		foreach ($this->filterFields as $field) {
			if(ClassUtils::getCleanName($field['filterName']) == $valueName) {
				return $field['value'];
			}
		}
		return null;
	}
	
	public function __set($valueName, $value) {
		foreach ($this->filterFields as $key => $field) {
			if(ClassUtils::getCleanName($field['filterName']) == $valueName) {
				$this->filterFields[$key]['value'] = $value;
				return $this;
			}
		}
		return $this;
	}
}