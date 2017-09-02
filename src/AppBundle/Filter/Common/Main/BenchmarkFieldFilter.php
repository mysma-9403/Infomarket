<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkFieldFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var string
	 */
	protected $fieldName;

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

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->fieldName = $this->getRequestString($request, 'field_name');
		
		$this->categories = $this->getRequestArray($request, 'categories');
		$this->fieldTypes = $this->getRequestArray($request, 'field_types');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->fieldName = null;
		
		$this->categories = array ();
		$this->fieldTypes = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'field_name', $this->fieldName);
		
		$this->setRequestArray($values, 'categories', $this->categories);
		$this->setRequestArray($values, 'field_types', $this->fieldTypes);
		
		return $values;
	}

	public function setFieldName($fieldName) {
		$this->fieldName = $fieldName;
		
		return $this;
	}

	public function getFieldName() {
		return $this->fieldName;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function setFieldTypes($fieldTypes) {
		$this->fieldTypes = $fieldTypes;
		
		return $this;
	}

	public function getFieldTypes() {
		return $this->fieldTypes;
	}
}