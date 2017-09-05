<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;

class CompareBenchmarkFieldFactory extends BenchmarkFieldFactoryRepositoryBase {

	public function create(array $properties, $categoryId) {
		$field = $this->initValueFieldProperty($properties);
		
		switch ($field['fieldType']) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
			case BenchmarkField::INTEGER_FIELD_TYPE:
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				$field = $this->initMinMaxProperties($field, $categoryId);
				break;
		}
		
		return $field;
	}
}