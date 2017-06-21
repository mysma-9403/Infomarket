<?php

namespace AppBundle\Utils\Entity\DataBase;

use AppBundle\Entity\BenchmarkField;

class BenchmarkFieldDataBaseUtils {
	
	const DECIMAL_NAME = 'decimal';
	const INTEGER_NAME = 'integer';
	const STRING_NAME = 'string';
	
	public static function getValueTypeDataBaseName($valueType) {
		switch($valueType) {
			case BenchmarkField::DECIMAL_VALUE_TYPE:
				return self::DECIMAL_NAME;
			case BenchmarkField::INTEGER_VALUE_TYPE:
				return self::INTEGER_NAME;
			case BenchmarkField::STRING_VALUE_TYPE:
				return self::STRING_NAME;
			default:
				return null;
		}
	}
	
	public static function getValueFieldProperty($valueType, $valueNumber) {
		return self::getValueTypeDataBaseName($valueType) . $valueNumber;
	}
	
	public static function getNoteFieldProperty($valueType, $valueNumber) {
		return self::getValueTypeDataBaseName($valueType) . 'Note' . $valueNumber;
	}
}