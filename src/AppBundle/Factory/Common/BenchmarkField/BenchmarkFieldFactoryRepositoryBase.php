<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;

abstract class BenchmarkFieldFactoryRepositoryBase extends BenchmarkFieldFactoryBase {

	/**
	 *
	 * @var ProductRepository
	 */
	protected $productRepository;

	public function __construct(BenchmarkFieldDataBaseUtils $benchmarkFieldDataBaseUtils, 
			ProductRepository $productRepository) {
		parent::__construct($benchmarkFieldDataBaseUtils);
		
		$this->productRepository = $productRepository;
	}

	protected function initMinMaxProperties($field, $categoryId) {
		$valueField = $field['valueField'];
		$minMaxValues = $this->productRepository->findMinMaxValues($categoryId, $valueField);
		
		$min = $minMaxValues['vmin'];
		$max = $minMaxValues['vmax'];
		
		$field['min'] = $min ? $min : 0;
		$field['max'] = $max ? $max : 0;
		
		return $field;
	}

	protected function initMinMaxEnumProperties($field, $categoryId) {
		$valueField = $field['valueField'];
		$min = $this->productRepository->findMinEnumValue($categoryId, $valueField);
		$max = $this->productRepository->findMaxEnumValue($categoryId, $valueField);
		
		$field['min'] = $min ? $min : 0;
		$field['max'] = $max ? $max : 0;
		
		return $field;
	}

	protected function initMinMaxMeanProperties($field, $categoryId) {
		$valueField = $field['valueField'];
		$minMaxAvgValues = $this->productRepository->findMinMaxAvgValues($categoryId, $valueField);
		
		$field['min'] = $minMaxAvgValues['vmin'];
		$field['max'] = $minMaxAvgValues['vmax'];
		$field['mean'] = $minMaxAvgValues['vavg'];
		
		return $field;
	}

	protected function initCountsProperty($field, $categoryId) {
		$valueField = $field['valueField'];
		$valueCounts = $this->productRepository->findValueCounts($categoryId, $valueField);
		
		$field['counts'] = $valueCounts;
		
		return $field;
	}

	protected function initMedianProperty($field, $categoryId) {
		$valueField = $field['valueField'];
		$values = $this->productRepository->findAllValues($categoryId, $valueField);
		
		$meanValue = null;
		
		if (count($values) > 0) {
			$halfIndex = count($values) / 2;
			$meanValue = $values[$halfIndex][$valueField];
		}
		$field['median'] = $meanValue;
		
		return $field;
	}

	protected function initTrueValuesCountProperty($field, $categoryId) {
		$valueField = $field['valueField'];
		$count = $this->productRepository->findItemsCount($categoryId, $valueField);
		
		$field['count'] = $count;
		
		return $field;
	}

	protected function initEnumValuesProperties($field, $categoryId) {
		$valueField = $field['valueField'];
		$values = $this->productRepository->findEnumValues($categoryId, $valueField);
		$values = array_map('current', $values);
		
		$items = [ ];
		foreach ($values as $value) {
			$singleValues = explode(", ", $value);
			foreach ($singleValues as $singleValue) {
				if (key_exists($singleValue, $items)) {
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