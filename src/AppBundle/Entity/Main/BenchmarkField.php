<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class BenchmarkField extends Simple {

	const DECIMAL_FIELD_TYPE = 11;

	const INTEGER_FIELD_TYPE = 21;

	const BOOLEAN_FIELD_TYPE = 22;

	const STRING_FIELD_TYPE = 31;

	const SINGLE_ENUM_FIELD_TYPE = 32;

	const MULTI_ENUM_FIELD_TYPE = 33;

	const NONE_NOTE_TYPE = 0;

	const ASC_NOTE_TYPE = 1;

	const DESC_NOTE_TYPE = 2;

	const ENUM_NOTE_TYPE = 3;

	const NONE_BETTER_THAN_TYPE = 0;

	const LT_BETTER_THAN_TYPE = 10;

	const GT_BETTER_THAN_TYPE = 20;
	
	public function __construct() {
		parent::__construct();
		
		$this->showField = false;
		$this->showFilter = false;
		$this->featuredField = false;
		$this->featuredFilter = false;
	}

	/**
	 *
	 * @var integer
	 */
	private $fieldType;

	/**
	 *
	 * @var integer
	 */
	private $valueNumber;

	/**
	 *
	 * @var string
	 */
	private $fieldName;

	/**
	 *
	 * @var integer
	 */
	private $fieldNumber;

	/**
	 *
	 * @var boolean
	 */
	private $showField;

	/**
	 *
	 * @var boolean
	 */
	private $featuredField;

	/**
	 *
	 * @var integer
	 */
	private $decimalPlaces;

	/**
	 *
	 * @var string
	 */
	private $filterName;

	/**
	 *
	 * @var integer
	 */
	private $filterNumber;

	/**
	 *
	 * @var boolean
	 */
	private $showFilter;

	/**
	 *
	 * @var boolean
	 */
	private $featuredFilter;

	/**
	 *
	 * @var integer
	 */
	private $noteType;

	/**
	 *
	 * @var integer
	 */
	private $noteWeight;

	/**
	 *
	 * @var integer
	 */
	private $betterThanType;

	/**
	 *
	 * @var integer
	 */
	private $compareWeight;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 * Set fieldType
	 *
	 * @param integer $fieldType        	
	 *
	 * @return BenchmarkField
	 */
	public function setFieldType($fieldType) {
		$this->fieldType = $fieldType;
		
		return $this;
	}

	/**
	 * Get fieldType
	 *
	 * @return integer
	 */
	public function getFieldType() {
		return $this->fieldType;
	}

	/**
	 * Set valueNumber
	 *
	 * @param integer $valueNumber        	
	 *
	 * @return BenchmarkField
	 */
	public function setValueNumber($valueNumber) {
		$this->valueNumber = $valueNumber;
		
		return $this;
	}

	/**
	 * Get valueNumber
	 *
	 * @return integer
	 */
	public function getValueNumber() {
		return $this->valueNumber;
	}

	/**
	 * Set fieldName
	 *
	 * @param string $fieldName        	
	 *
	 * @return BenchmarkField
	 */
	public function setFieldName($fieldName) {
		$this->fieldName = $fieldName;
		
		return $this;
	}

	/**
	 * Get fieldName
	 *
	 * @return string
	 */
	public function getFieldName() {
		return $this->fieldName;
	}

	/**
	 * Set fieldNumber
	 *
	 * @param integer $fieldNumber        	
	 *
	 * @return BenchmarkField
	 */
	public function setFieldNumber($fieldNumber) {
		$this->fieldNumber = $fieldNumber;
		
		return $this;
	}

	/**
	 * Get fieldNumber
	 *
	 * @return integer
	 */
	public function getFieldNumber() {
		return $this->fieldNumber;
	}

	/**
	 * Set showField
	 *
	 * @param boolean $showField        	
	 *
	 * @return BenchmarkField
	 */
	public function setShowField($showField) {
		$this->showField = $showField;
		
		return $this;
	}

	/**
	 * Get showField
	 *
	 * @return boolean
	 */
	public function getShowField() {
		return $this->showField;
	}

	/**
	 * Set featuredField
	 *
	 * @param boolean $featuredField        	
	 *
	 * @return BenchmarkField
	 */
	public function setFeaturedField($featuredField) {
		$this->featuredField = $featuredField;
		
		return $this;
	}

	/**
	 * Get featuredField
	 *
	 * @return boolean
	 */
	public function getFeaturedField() {
		return $this->featuredField;
	}

	/**
	 * Set decimalPlaces
	 *
	 * @param integer $decimalPlaces        	
	 *
	 * @return BenchmarkField
	 */
	public function setDecimalPlaces($decimalPlaces) {
		$this->decimalPlaces = $decimalPlaces;
		
		return $this;
	}

	/**
	 * Get decimalPlaces
	 *
	 * @return integer
	 */
	public function getDecimalPlaces() {
		return $this->decimalPlaces;
	}

	/**
	 * Set filterName
	 *
	 * @param string $filterName        	
	 *
	 * @return BenchmarkField
	 */
	public function setFilterName($filterName) {
		$this->filterName = $filterName;
		
		return $this;
	}

	/**
	 * Get filterName
	 *
	 * @return string
	 */
	public function getFilterName() {
		return $this->filterName;
	}

	/**
	 * Set filterNumber
	 *
	 * @param integer $filterNumber        	
	 *
	 * @return BenchmarkField
	 */
	public function setFilterNumber($filterNumber) {
		$this->filterNumber = $filterNumber;
		
		return $this;
	}

	/**
	 * Get filterNumber
	 *
	 * @return integer
	 */
	public function getFilterNumber() {
		return $this->filterNumber;
	}

	/**
	 * Set showFilter
	 *
	 * @param boolean $showFilter        	
	 *
	 * @return BenchmarkField
	 */
	public function setShowFilter($showFilter) {
		$this->showFilter = $showFilter;
		
		return $this;
	}

	/**
	 * Get showFilter
	 *
	 * @return boolean
	 */
	public function getShowFilter() {
		return $this->showFilter;
	}

	/**
	 * Set featuredFilter
	 *
	 * @param boolean $featuredFilter        	
	 *
	 * @return BenchmarkField
	 */
	public function setFeaturedFilter($featuredFilter) {
		$this->featuredFilter = $featuredFilter;
		
		return $this;
	}

	/**
	 * Get featuredFilter
	 *
	 * @return boolean
	 */
	public function getFeaturedFilter() {
		return $this->featuredFilter;
	}

	/**
	 * Set noteType
	 *
	 * @param integer $noteType        	
	 *
	 * @return BenchmarkField
	 */
	public function setNoteType($noteType) {
		$this->noteType = $noteType;
		
		return $this;
	}

	/**
	 * Get noteType
	 *
	 * @return integer
	 */
	public function getNoteType() {
		return $this->noteType;
	}

	/**
	 * Set noteWeight
	 *
	 * @param integer $noteWeight        	
	 *
	 * @return BenchmarkField
	 */
	public function setNoteWeight($noteWeight) {
		$this->noteWeight = $noteWeight;
		
		return $this;
	}

	/**
	 * Get noteWeight
	 *
	 * @return integer
	 */
	public function getNoteWeight() {
		return $this->noteWeight;
	}

	/**
	 * Set betterThanType
	 *
	 * @param integer $betterThanType        	
	 *
	 * @return BenchmarkField
	 */
	public function setBetterThanType($betterThanType) {
		$this->betterThanType = $betterThanType;
		
		return $this;
	}

	/**
	 * Get betterThanType
	 *
	 * @return integer
	 */
	public function getBetterThanType() {
		return $this->betterThanType;
	}

	/**
	 * Set compareWeight
	 *
	 * @param integer $compareWeight        	
	 *
	 * @return BenchmarkField
	 */
	public function setCompareWeight($compareWeight) {
		$this->compareWeight = $compareWeight;
		
		return $this;
	}

	/**
	 * Get compareWeight
	 *
	 * @return integer
	 */
	public function getCompareWeight() {
		return $this->compareWeight;
	}

	/**
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return BenchmarkField
	 */
	public function setCategory(\AppBundle\Entity\Main\Category $category = null) {
		$this->category = $category;
		
		return $this;
	}

	/**
	 * Get category
	 *
	 * @return \AppBundle\Entity\Main\Category
	 */
	public function getCategory() {
		return $this->category;
	}
}
