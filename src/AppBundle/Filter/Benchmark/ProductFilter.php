<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Utils\StringUtils;
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
	 * @var string
	 */
	protected $name = null;
	
	
	
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
		
		$this->name = $this->getRequestString($request, 'name');
		
		foreach ($this->filterFields as $key => $field) {
			switch($field['filterType']) {
				case BenchmarkField::DECIMAL_FILTER_TYPE:
				case BenchmarkField::INTEGER_FILTER_TYPE:
					$value = array();
					$value['min'] = $this->getRequestValue($request, StringUtils::getCleanName($field['filterName']) . '_min');
					$value['max'] = $this->getRequestValue($request, StringUtils::getCleanName($field['filterName']) . '_max');
					$this->filterFields[$key]['value'] = $value;
					break;
				case BenchmarkField::BOOLEAN_FILTER_TYPE:
					$this->filterFields[$key]['value'] = $this->getRequestBool($request, StringUtils::getCleanName($field['filterName']));
					break;
				case BenchmarkField::SINGLE_ENUM_FILTER_TYPE:
				case BenchmarkField::MULTI_ENUM_FILTER_TYPE:
					$this->filterFields[$key]['value'] = $this->getRequestArray($request, StringUtils::getCleanName($field['filterName']));
					break;
				default:
					$this->filterFields[$key]['value'] = $this->getRequestString($request, StringUtils::getCleanName($field['filterName']));
					break;
			}
		}
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->brands = array();
		$this->categories = array();
		
		$this->name = null;
		
		foreach ($this->filterFields as $key => $field) {
			switch($field['filterType']) {
				case BenchmarkField::DECIMAL_FILTER_TYPE:
				case BenchmarkField::INTEGER_FILTER_TYPE:
					$value = array();
					$value['min'] = null;
					$value['max'] = null;
					$this->filterFields[$key]['value'] = $value;
					break;
				case BenchmarkField::BOOLEAN_FILTER_TYPE:
					$this->filterFields[$key]['value'] = Filter::ALL_VALUES;
					break;
				case BenchmarkField::SINGLE_ENUM_FILTER_TYPE:
				case BenchmarkField::MULTI_ENUM_FILTER_TYPE:
					$this->filterFields[$key]['value'] = array();
					break;
				default:
					$this->filterFields[$key]['value'] = null;
					break;
			}
		}
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'brands', $this->brands);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		$this->setRequestString($values, 'name', $this->name);
		
		foreach ($this->filterFields as $field) {
			switch($field['filterType']) {
				case BenchmarkField::DECIMAL_FILTER_TYPE:
				case BenchmarkField::INTEGER_FILTER_TYPE:
					$this->setRequestValue($values, StringUtils::getCleanName($field['filterName']) . '_min', $field['value']['min']);
					$this->setRequestValue($values, StringUtils::getCleanName($field['filterName']) . '_max', $field['value']['max']);
					break;
				case BenchmarkField::BOOLEAN_FILTER_TYPE:
					$this->setRequestBool($values, StringUtils::getCleanName($field['filterName']), $field['value']);
					break;
				case BenchmarkField::SINGLE_ENUM_FILTER_TYPE:
				case BenchmarkField::MULTI_ENUM_FILTER_TYPE:
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
	
	public function __get($valueName) {
		foreach ($this->filterFields as $field) {
			switch ($field['filterType']) {
				case BenchmarkField::DECIMAL_FILTER_TYPE:
				case BenchmarkField::INTEGER_FILTER_TYPE:
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
			switch ($field['filterType']) {
				case BenchmarkField::DECIMAL_FILTER_TYPE:
				case BenchmarkField::INTEGER_FILTER_TYPE:
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
}