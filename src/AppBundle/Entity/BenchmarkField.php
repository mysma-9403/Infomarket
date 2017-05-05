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
	const SINGLE_ENUM_FIELD_TYPE = 32;
	const MULTI_ENUM_FIELD_TYPE = 33;
	
	
	
	const DECIMAL_FILTER_TYPE = 11;
	
	const INTEGER_FILTER_TYPE = 21;
	const BOOLEAN_FILTER_TYPE = 22;
	
	const STRING_FILTER_TYPE = 31;
	const SINGLE_ENUM_FILTER_TYPE = 32;
	const MULTI_ENUM_FILTER_TYPE = 33;
	
	
	
	const NONE_NOTE_TYPE = 0;
	const ASC_NOTE_TYPE = 1;
	const DESC_NOTE_TYPE = 2;
	
	const NONE_BETTER_THAN_TYPE = 0;
	const LT_BETTER_THAN_TYPE = 10;
	const LTE_BETTER_THAN_TYPE = 11;
	const GT_BETTER_THAN_TYPE = 20;
	const GTE_BETTER_THAN_TYPE = 21;
	const EQUAL_BETTER_THAN_TYPE = 30;
	
	
	public static function getValueTypeDBName($valueType) {
		switch($valueType) {
			case self::DECIMAL_VALUE_TYPE:
				return 'decimal';
			case self::INTEGER_VALUE_TYPE:
				return 'integer';
			case self::STRING_VALUE_TYPE:
				return 'string';
			default:
				return null;
		}
	}
	
	public static function getValueTypeName($valueType) {
		switch($valueType) {
			case self::DECIMAL_VALUE_TYPE:
				return 'label.benchmarkField.valueType.decimal';
			case self::INTEGER_VALUE_TYPE:
				return 'label.benchmarkField.valueType.integer';
			case self::STRING_VALUE_TYPE:
				return 'label.benchmarkField.valueType.string';
			default:
				return null;
		}
	}
	
	public static function getFieldTypeName($fieldType) {
		switch($fieldType) {
			case self::DECIMAL_FIELD_TYPE:
				return 'label.benchmarkField.fieldType.decimal';
			case self::INTEGER_FIELD_TYPE:
				return 'label.benchmarkField.fieldType.integer';
			case self::BOOLEAN_FIELD_TYPE:
				return 'label.benchmarkField.fieldType.boolean';
			case self::STRING_FIELD_TYPE:
				return 'label.benchmarkField.fieldType.string';
			case self::SINGLE_ENUM_FIELD_TYPE:
				return 'label.benchmarkField.fieldType.singleEnum';
			case self::MULTI_ENUM_FIELD_TYPE:
				return 'label.benchmarkField.fieldType.multiEnum';
			default:
				return null;
		}
	}
	
	public static function getFilterTypeName($filterType) {
		switch($filterType) {
			case self::DECIMAL_FILTER_TYPE:
				return 'label.benchmarkField.filterType.decimal';
			case self::INTEGER_FILTER_TYPE:
				return 'label.benchmarkField.filterType.integer';
			case self::BOOLEAN_FILTER_TYPE:
				return 'label.benchmarkField.filterType.boolean';
			case self::STRING_FILTER_TYPE:
				return 'label.benchmarkField.filterType.string';
			case self::SINGLE_ENUM_FILTER_TYPE:
				return 'label.benchmarkField.filterType.singleEnum';
			case self::MULTI_ENUM_FILTER_TYPE:
				return 'label.benchmarkField.filterType.multiEnum';
			default:
				return null;
		}
	}
	
	public static function getNoteTypeName($noteType) {
		switch($noteType) {
			case self::NONE_NOTE_TYPE:
				return 'label.benchmarkField.noteType.none';
			case self::ASC_NOTE_TYPE:
				return 'label.benchmarkField.noteType.ascending';
			case self::DESC_NOTE_TYPE:
				return 'label.benchmarkField.noteType.descending';
			default:
				return null;
		}
	}
	
	public static function getBetterThanTypeName($noteType) {
		switch($noteType) {
			case self::NONE_BETTER_THAN_TYPE:
				return 'label.benchmarkField.betterThanType.none';
			case self::LT_BETTER_THAN_TYPE:
				return 'label.benchmarkField.betterThanType.lesserThan';
			case self::LTE_BETTER_THAN_TYPE:
				return 'label.benchmarkField.betterThanType.lesserThanEqual';
			case self::GT_BETTER_THAN_TYPE:
				return 'label.benchmarkField.betterThanType.greaterThan';
			case self::GTE_BETTER_THAN_TYPE:
				return 'label.benchmarkField.betterThanType.greaterThanEqual';
			case self::EQUAL_BETTER_THAN_TYPE:
				return 'label.benchmarkField.betterThanType.equal';
			default:
				return null;
		}
	}
	
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
    /**
     * @var integer
     */
    private $decimalPlaces;


    /**
     * Set decimalPlaces
     *
     * @param integer $decimalPlaces
     *
     * @return BenchmarkField
     */
    public function setDecimalPlaces($decimalPlaces)
    {
        $this->decimalPlaces = $decimalPlaces;

        return $this;
    }

    /**
     * Get decimalPlaces
     *
     * @return integer
     */
    public function getDecimalPlaces()
    {
        return $this->decimalPlaces;
    }
    /**
     * @var integer
     */
    private $noteType;


    /**
     * Set noteType
     *
     * @param integer $noteType
     *
     * @return BenchmarkField
     */
    public function setNoteType($noteType)
    {
        $this->noteType = $noteType;

        return $this;
    }

    /**
     * Get noteType
     *
     * @return integer
     */
    public function getNoteType()
    {
        return $this->noteType;
    }
    /**
     * @var integer
     */
    private $noteWeight;


    /**
     * Set noteWeight
     *
     * @param integer $noteWeight
     *
     * @return BenchmarkField
     */
    public function setNoteWeight($noteWeight)
    {
        $this->noteWeight = $noteWeight;

        return $this;
    }

    /**
     * Get noteWeight
     *
     * @return integer
     */
    public function getNoteWeight()
    {
        return $this->noteWeight;
    }
    /**
     * @var integer
     */
    private $betterThanType;


    /**
     * Set betterThanType
     *
     * @param integer $betterThanType
     *
     * @return BenchmarkField
     */
    public function setBetterThanType($betterThanType)
    {
        $this->betterThanType = $betterThanType;

        return $this;
    }

    /**
     * Get betterThanType
     *
     * @return integer
     */
    public function getBetterThanType()
    {
        return $this->betterThanType;
    }
}
