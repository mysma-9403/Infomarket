<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * BenchmarkField
 */
class BenchmarkField extends Audit
{
	const DECIMAL_VALUE_TYPE = 11;
	const INTEGER_VALUE_TYPE = 21;
	const STRING_VALUE_TYPE = 31;
	
	
	
	const DECIMAL_FIELD_TYPE = 11;
	
	const INTEGER_FIELD_TYPE = 21;
	const BOOLEAN_FIELD_TYPE = 22;
	
	const STRING_FIELD_TYPE = 31;
	const ENUM_FIELD_TYPE = 32;
	
	
	
	const DECIMAL_FILTER_TYPE = 11;
	
	const INTEGER_FILTER_TYPE = 21;
	const BOOLEAN_FILTER_TYPE = 22;
	
	const STRING_FILTER_TYPE = 31;
	const ENUM_FILTER_TYPE = 32;
	
	
	
    /**
     * @var integer
     */
    private $valueType;

    /**
     * @var integer
     */
    private $valueNumber;

    /**
     * @var integer
     */
    private $fieldType;

    /**
     * @var integer
     */
    private $fieldNumber;

    /**
     * @var boolean
     */
    private $showField;

    /**
     * @var integer
     */
    private $filterType;

    /**
     * @var integer
     */
    private $filterNumber;

    /**
     * @var boolean
     */
    private $showFilter;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set valueType
     *
     * @param integer $valueType
     *
     * @return BenchmarkField
     */
    public function setValueType($valueType)
    {
        $this->valueType = $valueType;

        return $this;
    }

    /**
     * Get valueType
     *
     * @return integer
     */
    public function getValueType()
    {
        return $this->valueType;
    }

    /**
     * Set valueNumber
     *
     * @param integer $valueNumber
     *
     * @return BenchmarkField
     */
    public function setValueNumber($valueNumber)
    {
        $this->valueNumber = $valueNumber;

        return $this;
    }

    /**
     * Get valueNumber
     *
     * @return integer
     */
    public function getValueNumber()
    {
        return $this->valueNumber;
    }

    /**
     * Set fieldType
     *
     * @param integer $fieldType
     *
     * @return BenchmarkField
     */
    public function setFieldType($fieldType)
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    /**
     * Get fieldType
     *
     * @return integer
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

    /**
     * Set fieldNumber
     *
     * @param integer $fieldNumber
     *
     * @return BenchmarkField
     */
    public function setFieldNumber($fieldNumber)
    {
        $this->fieldNumber = $fieldNumber;

        return $this;
    }

    /**
     * Get fieldNumber
     *
     * @return integer
     */
    public function getFieldNumber()
    {
        return $this->fieldNumber;
    }

    /**
     * Set showField
     *
     * @param boolean $showField
     *
     * @return BenchmarkField
     */
    public function setShowField($showField)
    {
        $this->showField = $showField;

        return $this;
    }

    /**
     * Get showField
     *
     * @return boolean
     */
    public function getShowField()
    {
        return $this->showField;
    }

    /**
     * Set filterType
     *
     * @param integer $filterType
     *
     * @return BenchmarkField
     */
    public function setFilterType($filterType)
    {
        $this->filterType = $filterType;

        return $this;
    }

    /**
     * Get filterType
     *
     * @return integer
     */
    public function getFilterType()
    {
        return $this->filterType;
    }

    /**
     * Set filterNumber
     *
     * @param integer $filterNumber
     *
     * @return BenchmarkField
     */
    public function setFilterNumber($filterNumber)
    {
        $this->filterNumber = $filterNumber;

        return $this;
    }

    /**
     * Get filterNumber
     *
     * @return integer
     */
    public function getFilterNumber()
    {
        return $this->filterNumber;
    }

    /**
     * Set showFilter
     *
     * @param boolean $showFilter
     *
     * @return BenchmarkField
     */
    public function setShowFilter($showFilter)
    {
        $this->showFilter = $showFilter;

        return $this;
    }

    /**
     * Get showFilter
     *
     * @return boolean
     */
    public function getShowFilter()
    {
        return $this->showFilter;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return BenchmarkField
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var string
     */
    private $filterName;


    /**
     * Set fieldName
     *
     * @param string $fieldName
     *
     * @return BenchmarkField
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set filterName
     *
     * @param string $filterName
     *
     * @return BenchmarkField
     */
    public function setFilterName($filterName)
    {
        $this->filterName = $filterName;

        return $this;
    }

    /**
     * Get filterName
     *
     * @return string
     */
    public function getFilterName()
    {
        return $this->filterName;
    }
}
