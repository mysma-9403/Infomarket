<?php

namespace AppBundle\Logic\Benchmark\Fields;

use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Entity\BenchmarkField;

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
	
	
	
	
	public function initValueField($field) {
		$valueField = BenchmarkField::getValueTypeDBName($field['valueType']) . $field['valueNumber'];
		$field['valueField'] = $valueField;
		
		return $field;
	}
	
	
	
	public function initMinMaxAvgValues($field) {
		$valueField = $field['valueField'];
		$minMaxAvgValues = $this->productRepository->findMinMaxAvgValues($this->categoryId, $valueField);
		
		$field['min'] = $minMaxAvgValues['vmin'];
		$field['max'] = $minMaxAvgValues['vmax'];
		$field['mean'] = $minMaxAvgValues['vavg'];
		
		return $field;
	}
	
	public function initModeValue($field) {
		$valueField = $field['valueField'];
		$valueCounts = $this->productRepository->findValueCounts($this->categoryId, $valueField);
		
		$mode = null;
		$maxCount = null;
		
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
	
	public function initMeanValue($field) {
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
	
	public function initTrueValuesCount($field) {
		$valueField = $field['valueField'];
		$count = $this->productRepository->findItemsCount($this->categoryId, $valueField);
		
		$field['count'] = $count;
		
		return $field;
	}
	
	public function initEnumValues($field) {
		$valueField = $field['valueField'];
		$values = $this->productRepository->findEnumValues($this->categoryId, $valueField);
		$values = array_map('current', $values);
		
		$items = [];
		foreach ($values as $value) {
			$singleValues = explode(", ", $value);
			foreach ($singleValues as $singleValue) {
				$items[$singleValue] = $singleValue;
			}
		}
		$field['values'] = join(", ", $items);
		
		return $field;
	}
}