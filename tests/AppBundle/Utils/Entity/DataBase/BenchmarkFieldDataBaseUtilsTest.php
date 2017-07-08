<?php

namespace tests\AppBundle\Utils\Entity\DataBase;

use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use PHPUnit\Framework\TestCase;
use AppBundle\Entity\BenchmarkField;

/**
 * BenchmarkFieldDataBaseUtilsTest
 */
class BenchmarkFieldDataBaseUtilsTest extends TestCase {
	
	const INVALID_FIELD_TYPE = 99;
	
	const VALUE_NUMBER = 3;
	
	
	/**
	 * 
	 * @var BenchmarkFieldDataBaseUtils
	 */
	private $utils;
	
	
	public function __construct() {
		$this->utils = new BenchmarkFieldDataBaseUtils();
	}
	
	
	public function testGivenDecimalThenDecimalValueFieldIsSet() {
		$result = $this->utils->getValueFieldProperty(BenchmarkField::DECIMAL_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::DECIMAL_NAME . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenIntegerThenIntegerValueFieldIsSet() {
		$result = $this->utils->getValueFieldProperty(BenchmarkField::INTEGER_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::INTEGER_NAME . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenBooleanThenIntegerValueFieldIsSet() {
		$result = $this->utils->getValueFieldProperty(BenchmarkField::BOOLEAN_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::INTEGER_NAME . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenSingleEnumThenStringValueFieldIsSet() {
		$result = $this->utils->getValueFieldProperty(BenchmarkField::SINGLE_ENUM_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::STRING_NAME . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenMultiEnumThenStringValueFieldIsSet() {
		$result = $this->utils->getValueFieldProperty(BenchmarkField::MULTI_ENUM_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::STRING_NAME . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenStringThenStringValueFieldIsSet() {
		$result = $this->utils->getValueFieldProperty(BenchmarkField::STRING_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::STRING_NAME . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenInvalidThenValueExceptionIsThrown() {
		$exceptionThrown = false;
		try {
			$this->utils->getValueFieldProperty(self::INVALID_FIELD_TYPE, self::VALUE_NUMBER);
		} catch(\InvalidArgumentException $ex) {
			$exceptionThrown = true;
		}
		$this->assertTrue($exceptionThrown);
	}
	
	
	public function testGivenDecimalThenDecimalNoteFieldIsSet() {
		$result = $this->utils->getNoteFieldProperty(BenchmarkField::DECIMAL_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::DECIMAL_NAME . BenchmarkFieldDataBaseUtils::NOTE . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenIntegerThenIntegerNoteFieldIsSet() {
		$result = $this->utils->getNoteFieldProperty(BenchmarkField::INTEGER_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::INTEGER_NAME . BenchmarkFieldDataBaseUtils::NOTE . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenBooleanThenIntegerNoteFieldIsSet() {
		$result = $this->utils->getNoteFieldProperty(BenchmarkField::BOOLEAN_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::INTEGER_NAME . BenchmarkFieldDataBaseUtils::NOTE . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenSingleEnumThenStringNoteFieldIsSet() {
		$result = $this->utils->getNoteFieldProperty(BenchmarkField::SINGLE_ENUM_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::STRING_NAME . BenchmarkFieldDataBaseUtils::NOTE . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenMultiEnumThenStringNoteFieldIsSet() {
		$result = $this->utils->getNoteFieldProperty(BenchmarkField::MULTI_ENUM_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::STRING_NAME . BenchmarkFieldDataBaseUtils::NOTE . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenStringThenStringNoteFieldIsSet() {
		$result = $this->utils->getNoteFieldProperty(BenchmarkField::STRING_FIELD_TYPE, self::VALUE_NUMBER);
		$this->assertEquals(BenchmarkFieldDataBaseUtils::STRING_NAME . BenchmarkFieldDataBaseUtils::NOTE . self::VALUE_NUMBER, $result);
	}
	
	public function testGivenInvalidThenNoteExceptionIsThrown() {
		$exceptionThrown = false;
		try {
			$this->utils->getNoteFieldProperty(self::INVALID_FIELD_TYPE, self::VALUE_NUMBER);
		} catch(\InvalidArgumentException $ex) {
			$exceptionThrown = true;
		}
		$this->assertTrue($exceptionThrown);
	}
}