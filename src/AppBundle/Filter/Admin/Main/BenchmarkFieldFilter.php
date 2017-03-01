<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;


class BenchmarkFieldFilter extends SimpleEntityFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $categories;
	
	/**
	 *
	 * @var array
	 */
	protected $fieldTypes;
	
	/**
	 *
	 * @var string
	 */
	protected $fieldName;
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->categories = $this->getRequestArray($request, 'categories');
		$this->fieldTypes = $this->getRequestArray($request, 'field_types');
		
		$this->fieldName = $this->getRequestArray($request, 'field_name');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->categories = array();
		$this->fieldTypes = array();
		
		$this->fieldName = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'categories', $this->categories);
		$this->setRequestArray($values, 'field_types', $this->fieldTypes);
		
		$this->setRequestString($values, 'field_name', $this->fieldName);
		
		return $values;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return BenchmarkFieldFilter
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
	 * Set field types
	 *
	 * @param array $articleCategories
	 *
	 * @return BenchmarkFieldFilter
	 */
	public function setFieldTypes($fieldTypes)
	{
		$this->fieldTypes = $fieldTypes;
	
		return $this;
	}
	
	/**
	 * Get field types
	 *
	 * @return array
	 */
	public function getFieldTypes()
	{
		return $this->fieldTypes;
	}
	
	/**
	 * Set field name
	 *
	 * @param string $articleCategories
	 *
	 * @return BenchmarkFieldFilter
	 */
	public function setFieldName($fieldName)
	{
		$this->fieldName = $fieldName;
	
		return $this;
	}
	
	/**
	 * Get field name
	 *
	 * @return string
	 */
	public function getFieldName()
	{
		return $this->fieldName;
	}
}