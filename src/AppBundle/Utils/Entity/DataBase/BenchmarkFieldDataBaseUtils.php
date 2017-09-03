<?php

namespace AppBundle\Utils\Entity\DataBase;

use AppBundle\Entity\Main\BenchmarkField;

class BenchmarkFieldDataBaseUtils {

	const DECIMAL_NAME = 'decimal';

	const INTEGER_NAME = 'integer';

	const STRING_NAME = 'string';

	const NOTE = 'Note';

	public function getValueFieldProperty($fieldType, $valueNumber) {
		return $this->getFieldTypeDataBaseName($fieldType) . $valueNumber;
	}

	public function getNoteFieldProperty($fieldType, $valueNumber) {
		return $this->getFieldTypeDataBaseName($fieldType) . self::NOTE . $valueNumber;
	}

	protected function getFieldTypeDataBaseName($fieldType) {
		switch ($fieldType) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
				return self::DECIMAL_NAME;
			case BenchmarkField::INTEGER_FIELD_TYPE:
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				return self::INTEGER_NAME;
			case BenchmarkField::STRING_FIELD_TYPE:
			case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
			case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
				return self::STRING_NAME;
			default:
				throw new \InvalidArgumentException('Invalid benchmark field type.');
		}
	}
}