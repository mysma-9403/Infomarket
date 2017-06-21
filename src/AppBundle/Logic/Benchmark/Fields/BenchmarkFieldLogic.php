<?php

namespace AppBundle\Logic\Benchmark\Fields;

use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;

class BenchmarkFieldLogic {
	
	/**
	 * 
	 * @var ProductRepository
	 */
	protected $productRepository;
	
	/**
	 * 
	 * @var integer
	 */
	protected $categoryId;
	
	
	
	
	public function __construct(ProductRepository $productRepository, $categoryId) {
		$this->productRepository = $productRepository;
		$this->categoryId = $categoryId;
	}
	
	
	
	public function initNoteFieldProperties($field) {
		$field = $this->initValueFieldProperty($field);
		$field = $this->initNoteFieldProperty($field);
		
		switch($field['fieldType']) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
			case BenchmarkField::INTEGER_FIELD_TYPE:
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				$field = $this->initMinMaxProperties($field);
				break;
			case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
			case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
				$field = $this->initMinMaxEnumProperties($field);
				break;
		}
		
		return $field;
	}
	
	public function initCompareFieldProperties($field) {
		$field = $this->initValueFieldProperty($field);
		
		switch($field['fieldType']) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
			case BenchmarkField::INTEGER_FIELD_TYPE:
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				$field = $this->initMinMaxProperties($field);
				break;
		}
	
		return $field;
	}
	
	public function initCategoryFieldProperties($field, $initValueField = true) {
		if($initValueField)
			$field = $this->initValueFieldProperty($field);
		
		switch($field['fieldType']) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
			case BenchmarkField::INTEGER_FIELD_TYPE:
				$field = $this->initMinMaxMeanProperties($field);
				$field = $this->initCountsProperty($field);
				$field = $this->initModeProperty($field);
				$field = $this->initMedianProperty($field);
				break;
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				$field = $this->initTrueValuesCountProperty($field);
				break;
			case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
			case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
				$field = $this->initEnumValuesProperties($field);
				break;
		}
		
		return $field;
	}
	
	protected function initValueFieldProperty($field) {
		$field['valueField'] = BenchmarkFieldDataBaseUtils::getValueFieldProperty($field['valueType'], $field['valueNumber']);
	
		return $field;
	}
	
	protected function initNoteFieldProperty($field) {
		$field['noteField'] = BenchmarkFieldDataBaseUtils::getNoteFieldProperty($field['valueType'], $field['valueNumber']);
	
		return $field;
	}
	
	protected function initMinMaxProperties($field) {
		$valueField = $field['valueField'];
		$minMaxValues = $this->productRepository->findMinMaxValues($this->categoryId, $valueField);
	
		$min = $minMaxValues['vmin'];
		$max = $minMaxValues['vmax'];
		
		$field['min'] = $min ? $min : 0;
		$field['max'] = $max ? $max : 0;
	
		return $field;
	}
	
	protected function initMinMaxEnumProperties($field) {
		$valueField = $field['valueField'];
		$min = $this->productRepository->findMinEnumValue($this->categoryId, $valueField);
		$max = $this->productRepository->findMaxEnumValue($this->categoryId, $valueField);
		
		$field['min'] = $min ? $min : 0;
		$field['max'] = $max ? $max : 0;
		
		return $field;
	}
	
	protected function initMinMaxMeanProperties($field) {
		$valueField = $field['valueField'];
		$minMaxAvgValues = $this->productRepository->findMinMaxAvgValues($this->categoryId, $valueField);
		
		$field['min'] = $minMaxAvgValues['vmin'];
		$field['max'] = $minMaxAvgValues['vmax'];
		$field['mean'] = $minMaxAvgValues['vavg'];
		
		return $field;
	}
	
	protected function initCountsProperty($field) {
		$valueField = $field['valueField'];
		$valueCounts = $this->productRepository->findValueCounts($this->categoryId, $valueField);
		
		$field['counts'] = $valueCounts;
		
		return $field;
	}
	
	protected function initModeProperty($field) {	
		$valueField = $field['valueField'];
		$valueCounts = $field['counts'];
		$maxCount = null;
		$mode = null;
		
		foreach ($valueCounts as $valueCount) {
			$count = $valueCount['vcount'];
			if($count > $maxCount) {
				$maxCount = $count;
				$mode = $valueCount[$valueField];
			}
		}
		$field['mode'] = $mode;
		
		return $field;
	}
	
	protected function initMedianProperty($field) {
		$valueField = $field['valueField'];
		$values = $this->productRepository->findAllValues($this->categoryId, $valueField);
    		
    	$meanValue = null;
    	
    	if(count($values) > 0) {
	    	$halfIndex = count($values) / 2;
	    	$meanValue = $values[$halfIndex][$valueField];
    	}
    	$field['median'] = $meanValue;
	
		return $field;
	}
	
	protected function initTrueValuesCountProperty($field) {
		$valueField = $field['valueField'];
		$count = $this->productRepository->findItemsCount($this->categoryId, $valueField);
		
		$field['count'] = $count;
		
		return $field;
	}
	
	protected function initEnumValuesProperties($field) {
		$valueField = $field['valueField'];
		$values = $this->productRepository->findEnumValues($this->categoryId, $valueField);
		$values = array_map('current', $values);
		
		$items = [];
		foreach ($values as $value) {
			$singleValues = explode(", ", $value);
			foreach ($singleValues as $singleValue) {
				if(key_exists($singleValue, $items)) {
					$items[$singleValue] = $items[$singleValue] + 1;
				} else {
					$items[$singleValue] = 1;
				}
			}
		}
		$field['valueCounts'] = $items;
		$field['values'] = join(", ", array_keys($items));
		
		return $field;
	}
}