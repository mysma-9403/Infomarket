<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\BenchmarkField;

class CategoryBenchmarkFieldFactory extends BenchmarkFieldFactoryRepositoryBase {
	
	
	public function create(array $properties, $categoryId) {
		if(!key_exists('valueField', $properties)) {
			$properties = $this->initValueFieldProperty($properties);
		}
		
		switch($properties['fieldType']) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
			case BenchmarkField::INTEGER_FIELD_TYPE:
				$properties = $this->initMinMaxMeanProperties($properties, $categoryId);
				$properties = $this->initCountsProperty($properties, $categoryId);
				$properties = $this->initMedianProperty($properties, $categoryId);
				$properties = $this->initModeProperty($properties);
				break;
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				$properties = $this->initTrueValuesCountProperty($properties, $categoryId);
				break;
			case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
			case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
				$properties = $this->initEnumValuesProperties($properties, $categoryId);
				break;
		}
		
		return $properties;
	}
}