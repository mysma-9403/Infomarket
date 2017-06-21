<?php

namespace tests\AppBundle\Utils\Entity\DataBase;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use PHPUnit\Framework\TestCase;

/**
 * BenchmarkFieldDataBaseUtilsTest
 */
class BenchmarkFieldDataBaseUtilsTest extends TestCase
{	
	const INVALID_VALUE_TYPE = 99;
	
	const VALUE_TYPE = BenchmarkField::DECIMAL_FIELD_TYPE;
	const VALUE_NUMBER = 3;
	
	
	
	public function testGivenDecimalFieldThenDecimalNameGiven() {
		$result = BenchmarkFieldDataBaseUtils::getValueTypeDataBaseName(BenchmarkField::DECIMAL_FIELD_TYPE);
		
		$this->assertEquals(BenchmarkFieldDataBaseUtils::DECIMAL_NAME, $result);
	}
	
	public function testGivenIntegerFieldThenIntegerNameGiven() {
		$result = BenchmarkFieldDataBaseUtils::getValueTypeDataBaseName(BenchmarkField::INTEGER_FIELD_TYPE);
		
		$this->assertEquals(BenchmarkFieldDataBaseUtils::INTEGER_NAME, $result);
	}
	
	public function testGivenStringFieldThenStringNameGiven() {
		$result = BenchmarkFieldDataBaseUtils::getValueTypeDataBaseName(BenchmarkField::STRING_FIELD_TYPE);
		
		$this->assertEquals(BenchmarkFieldDataBaseUtils::STRING_NAME, $result);
	}
	
	public function testGivenInvalidFieldThenNullGiven() {
		$result = BenchmarkFieldDataBaseUtils::getValueTypeDataBaseName(self::INVALID_VALUE_TYPE);
		
		$this->assertEquals(null, $result);
	}
	
	
	
	public function testGivenValueThenValueFieldGiven() {
		$expected = BenchmarkFieldDataBaseUtils::getValueTypeDataBaseName(self::VALUE_TYPE) . self::VALUE_NUMBER;
		$result = BenchmarkFieldDataBaseUtils::getValueFieldProperty(self::VALUE_TYPE, self::VALUE_NUMBER);
		
		$this->assertEquals($expected, $result);
	}
	
	public function testGivenValueThenNoteFieldGiven() {
		$expected = BenchmarkFieldDataBaseUtils::getValueTypeDataBaseName(self::VALUE_TYPE) . "Note" . self::VALUE_NUMBER;
		$result = BenchmarkFieldDataBaseUtils::getNoteFieldProperty(self::VALUE_TYPE,  self::VALUE_NUMBER);
		
		$this->assertEquals($expected, $result);
	}
}