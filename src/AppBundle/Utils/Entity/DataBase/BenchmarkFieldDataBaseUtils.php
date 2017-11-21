<?php

namespace AppBundle\Utils\Entity\DataBase;

use AppBundle\Entity\Main\BenchmarkField;

class BenchmarkFieldDataBaseUtils {

	const DECIMAL_NAME = 'decimal';

	const INTEGER_NAME = 'integer';

	const STRING_NAME = 'string';

	const NOTE = 'Note';

	const MIN = 'Min';

	const MAX = 'Max';

	const MEAN = 'Mean';

	const MODE = 'Mode';

	const MEDIAN = 'Median';
	
	const DISTRIBUTION = 'Distribution';

	public function getValueField(BenchmarkField $field) {
		return $this->getDataBaseName($field->getFieldType()) . $field->getValueNumber();
	}

	public function getNoteField(BenchmarkField $field) {
		return $this->getDataBaseName($field->getFieldType()) . self::NOTE . $field->getValueNumber();
	}

	public function getMinField(BenchmarkField $field) {
		return $this->getDataBaseName($field->getFieldType()) . self::MIN . $field->getValueNumber();
	}

	public function getMaxField(BenchmarkField $field) {
		return $this->getDataBaseName($field->getFieldType()) . self::MAX . $field->getValueNumber();
	}

	public function getMeanField(BenchmarkField $field) {
		return $this->getDataBaseName($field->getFieldType()) . self::MEAN . $field->getValueNumber();
	}

	public function getModeField(BenchmarkField $field) {
		return $this->getDataBaseName($field->getFieldType()) . self::MODE . $field->getValueNumber();
	}

	public function getMedianField(BenchmarkField $field) {
		return $this->getDataBaseName($field->getFieldType()) . self::MEDIAN . $field->getValueNumber();
	}
	
	public function getDistributionField(BenchmarkField $field) {
		return $this->getDataBaseName($field->getFieldType()) . self::DISTRIBUTION . $field->getValueNumber();
	}

	protected function getDataBaseName($fieldType) {
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