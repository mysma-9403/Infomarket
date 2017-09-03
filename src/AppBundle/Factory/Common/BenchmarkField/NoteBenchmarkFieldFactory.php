<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;

class NoteBenchmarkFieldFactory extends BenchmarkFieldFactoryRepositoryBase {

	public function create(array $properties, $categoryId) {
		$field = $this->initValueFieldProperty($properties);
		$field = $this->initNoteFieldProperty($field);
		
		switch ($field['fieldType']) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
			case BenchmarkField::INTEGER_FIELD_TYPE:
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				$field = $this->initMinMaxProperties($field, $categoryId);
				break;
			case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
			case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
				$field = $this->initMinMaxEnumProperties($field, $categoryId);
				break;
		}
		
		return $field;
	}
}