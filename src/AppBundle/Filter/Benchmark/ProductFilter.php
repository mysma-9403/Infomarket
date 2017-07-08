<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Filter\Base\Filter;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Utils\StringUtils;
use Symfony\Component\HttpFoundation\Request;

class ProductFilter extends Filter {
	
	/**
	 * 
	 * @var BenchmarkFieldsProvider
	 */
	protected $benchmarkFieldsProvider;
	
	/**
	 *
	 * @var BenchmarkFieldsInitializer
	 */
	protected $showFieldsInitializer;
	
	/**
	 *
	 * @var BenchmarkFieldsInitializer
	 */
	protected $filterFieldsInitializer;
	
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
	 * @var string
	 */
	protected $name = null;
	
	/**
	 *
	 * @var double
	 */
	protected $minPrice = null;
	
	/**
	 *
	 * @var double
	 */
	protected $maxPrice = null;
	
	
	protected $benchmarkQuery = null;
	
	
	public function __construct(BenchmarkFieldsProvider $benchmarkFieldsProvider, 
			BenchmarkFieldsInitializer $showFieldsInitializer, 
			BenchmarkFieldsInitializer $filterFieldsInitializer) {
		$this->benchmarkFieldsProvider = $benchmarkFieldsProvider;
		$this->showFieldsInitializer = $showFieldsInitializer;
		$this->filterFieldsInitializer = $filterFieldsInitializer;
		
		$this->filterName = 'product_';
	}
	
	public function initContextParams(array $contextParams) {
		$this->contextCategory = $contextParams['subcategory'];
		
		//TODO check if it can be used to not recalculate fields in ProductManager index
		$fields = $this->benchmarkFieldsProvider->getShowFields($this->contextCategory);
		$this->showFields = $this->showFieldsInitializer->init($fields, $this->contextCategory);
		
		$fields = $this->benchmarkFieldsProvider->getFilterFields($this->contextCategory);
		$this->filterFields = $this->filterFieldsInitializer->init($fields, $this->contextCategory);
	}
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->brands = $this->getRequestArray($request, 'brands');
		$this->categories = $this->getRequestArray($request, 'categories');
		
		$this->name = $this->getRequestString($request, 'name');
		
		$this->minPrice = $this->getRequestValue($request, 'price_min');
		$this->maxPrice = $this->getRequestValue($request, 'price_max');
		
		foreach ($this->filterFields as $key => $field) {
			switch($field['fieldType']) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
				case BenchmarkField::INTEGER_FIELD_TYPE:
					$value = array();
					$value['min'] = $this->getRequestValue($request, StringUtils::getCleanName($field['filterName']) . '_min');
					$value['max'] = $this->getRequestValue($request, StringUtils::getCleanName($field['filterName']) . '_max');
					$this->filterFields[$key]['value'] = $value;
					break;
				case BenchmarkField::BOOLEAN_FIELD_TYPE:
					$this->filterFields[$key]['value'] = $this->getRequestBool($request, StringUtils::getCleanName($field['filterName']));
					break;
				case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
				case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
					$this->filterFields[$key]['value'] = $this->getRequestArray($request, StringUtils::getCleanName($field['filterName']));
					break;
				default:
					$this->filterFields[$key]['value'] = $this->getRequestString($request, StringUtils::getCleanName($field['filterName']));
					break;
			}
		}
		
		$this->benchmarkQuery = $this->getRequestValue($request, 'benchmark_query');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->brands = array();
		$this->categories = array();
		
		$this->name = null;
		
		$this->minPrice = null;
		$this->maxPrice = null;
		
		foreach ($this->filterFields as $key => $field) {
			switch($field['fieldType']) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
				case BenchmarkField::INTEGER_FIELD_TYPE:
					$value = array();
					$value['min'] = null;
					$value['max'] = null;
					$this->filterFields[$key]['value'] = $value;
					break;
				case BenchmarkField::BOOLEAN_FIELD_TYPE:
					$this->filterFields[$key]['value'] = Filter::ALL_VALUES;
					break;
				case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
				case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
					$this->filterFields[$key]['value'] = array();
					break;
				default:
					$this->filterFields[$key]['value'] = null;
					break;
			}
		}
		
		$this->benchmarkQuery = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'brands', $this->brands);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		$this->setRequestString($values, 'name', $this->name);
		
		$this->setRequestValue($values, 'price_min', $this->minPrice);
		$this->setRequestValue($values, 'price_max', $this->maxPrice);
		
		foreach ($this->filterFields as $field) {
			switch($field['fieldType']) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
				case BenchmarkField::INTEGER_FIELD_TYPE:
					$this->setRequestValue($values, StringUtils::getCleanName($field['filterName']) . '_min', $field['value']['min']);
					$this->setRequestValue($values, StringUtils::getCleanName($field['filterName']) . '_max', $field['value']['max']);
					break;
				case BenchmarkField::BOOLEAN_FIELD_TYPE:
					$this->setRequestBool($values, StringUtils::getCleanName($field['filterName']), $field['value']);
					break;
				case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
				case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
					$this->setRequestArray($values, StringUtils::getCleanName($field['filterName']), $field['value']);
					break;
				default:
					$this->setRequestString($values, StringUtils::getCleanName($field['filterName']), $field['value']);
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
	 * Get brands
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
	 * Get categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return ProductFilter
	 */
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Set minPrice
	 *
	 * @param array $minPrice
	 *
	 * @return ProductFilter
	 */
	public function setMinPrice($minPrice)
	{
		$this->minPrice = $minPrice;
	
		return $this;
	}
	
	/**
	 * Get minPrice
	 *
	 * @return array
	 */
	public function getMinPrice()
	{
		return $this->minPrice;
	}
	
	/**
	 * Set maxPrice
	 *
	 * @param array $maxPrice
	 *
	 * @return ProductFilter
	 */
	public function setMaxPrice($maxPrice)
	{
		$this->maxPrice = $maxPrice;
	
		return $this;
	}
	
	/**
	 * Get maxPrice
	 *
	 * @return array
	 */
	public function getMaxPrice()
	{
		return $this->maxPrice;
	}
	
	
	
	public function __get($valueName) {
		foreach ($this->filterFields as $field) {
			switch ($field['fieldType']) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
				case BenchmarkField::INTEGER_FIELD_TYPE:
					if(StringUtils::getCleanName($field['filterName']) . '_min' == $valueName) {
						return $field['value']['min'];
					}
					if(StringUtils::getCleanName($field['filterName']) . '_max' == $valueName) {
						return $field['value']['max'];
					}
					break;
				default:
					if(StringUtils::getCleanName($field['filterName']) == $valueName) {
						return $field['value'];
					}
			}
		}
		
		return null;
	}
	
	public function __set($valueName, $value) {
		foreach ($this->filterFields as $key => $field) {
			switch ($field['fieldType']) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
				case BenchmarkField::INTEGER_FIELD_TYPE:
					if(StringUtils::getCleanName($field['filterName']) . '_min' == $valueName) {
						$this->filterFields[$key]['value']['min'] = $value;
						return $this;
					}
					if(StringUtils::getCleanName($field['filterName']) . '_max' == $valueName) {
						$this->filterFields[$key]['value']['max'] = $value;
						return $this;
					}
					break;
				default:
					if(StringUtils::getCleanName($field['filterName']) == $valueName) {
						$this->filterFields[$key]['value'] = $value;
						return $this;
					}
			}
		}
		return $this;
	}
	
	public function getBenchmarkQuery() {
		return $this->benchmarkQuery;
	}
	
	public function setBenchmarkQuery($benchmarkQuery) {
		$this->benchmarkQuery = $benchmarkQuery;
		return $this;
	}
}