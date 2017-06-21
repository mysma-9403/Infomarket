<?php

namespace Tests\AppBundle\Logic\Benchmark\Fields;

use PHPUnit\Framework\TestCase;
use AppBundle\Logic\Benchmark\Fields\BenchmarkFieldLogic;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;

class BenchmarkFieldLogicTest extends TestCase {
	
	const CATEGORY_ID = 100;
	
	
	
	const DECIMAL_NUMBER = 11;
	const DECIMAL_MIN = 11.5;
	const DECIMAL_MAX = 17.5;
	
	const DECIMAL_FIELD = [ 
			'valueType' => BenchmarkField::DECIMAL_FIELD_TYPE,
			'valueNumber' => self::DECIMAL_NUMBER 
	];
	
	const DECIMAL_MIN_MAX = [ 
			'vmin' => self::DECIMAL_MIN,
			'vmax' => self::DECIMAL_MAX 
	];
	
	
	
	const INTEGER_NUMBER = 19;
	const INTEGER_MIN = 1100;
	const INTEGER_MAX = 1600;
	
	const INTEGER_FIELD = [
			'valueType' => BenchmarkField::INTEGER_FIELD_TYPE,
			'valueNumber' => self::INTEGER_NUMBER
	];
	
	const INTEGER_MIN_MAX = [
			'vmin' => self::INTEGER_MIN,
			'vmax' => self::INTEGER_MAX
	];
	
	
	
	const BOOLEAN_NUMBER = 3;
	const BOOLEAN_MIN = 0;
	const BOOLEAN_MAX = 1;
	
	const BOOLEAN_FIELD = [
			'valueType' => BenchmarkField::BOOLEAN_FIELD_TYPE,
			'valueNumber' => self::BOOLEAN_NUMBER
	];
	
	const BOOLEAN_MIN_MAX = [
			'vmin' => self::BOOLEAN_MIN,
			'vmax' => self::BOOLEAN_MAX
	];
	
	
	
	
	const SINGLE_ENUM_NUMBER = 7;
	const SINGLE_ENUM_MIN = 10;
	const SINGLE_ENUM_MAX = 70;
	
	const SINGLE_ENUM_FIELD = [
			'valueType' => BenchmarkField::SINGLE_ENUM_FIELD_TYPE,
			'valueNumber' => self::SINGLE_ENUM_NUMBER
	];
	
	
	
	/**
	 *
	 * @var BenchmarkFieldLogic $logic
	 */
	private $logic;
	
	
	
	public function __construct() {
		$this->logic = new BenchmarkFieldLogic ( $this->getRepositoryMock (), self::CATEGORY_ID );
	}
	
	private function getRepositoryMock() {
		$repository = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
		
		$repository
		->expects ( $this->atMost(1) )
		->method ( 'findMinMaxValues' )
		->willReturnMap([
				[self::CATEGORY_ID, self::getValueField(self::DECIMAL_FIELD), self::DECIMAL_MIN_MAX],
				[self::CATEGORY_ID, self::getValueField(self::INTEGER_FIELD), self::INTEGER_MIN_MAX],
				[self::CATEGORY_ID, self::getValueField(self::BOOLEAN_FIELD), self::BOOLEAN_MIN_MAX]
		]);
		
		$repository
		->expects ( $this->atMost(1) )
		->method ( 'findMaxEnumValue' )
		->willReturnMap([
				[self::CATEGORY_ID, self::getValueField(self::SINGLE_ENUM_FIELD), self::SINGLE_ENUM_MAX]
		]);
		
		$repository
		->expects ( $this->atMost(1) )
		->method ( 'findMinEnumValue' )
		->willReturnMap([
				[self::CATEGORY_ID, self::getValueField(self::SINGLE_ENUM_FIELD), self::SINGLE_ENUM_MIN]
		]);
		
		return $repository;
	}
	
	
	
	public function testGivenDecimalFieldThenNotePropertiesAreSet() {
		$result = self::DECIMAL_FIELD;
		$result = $this->logic->initNoteFieldProperties ($result);
		
		$expected = [
				'valueType' => self::DECIMAL_FIELD ['valueType'],
				'valueNumber' => self::DECIMAL_FIELD ['valueNumber'],
				'valueField' => self::getValueField(self::DECIMAL_FIELD),
				'noteField' => self::getNoteField(self::DECIMAL_FIELD),
				'min' => self::DECIMAL_MIN_MAX ['vmin'],
				'max' => self::DECIMAL_MIN_MAX ['vmax']
		];
		
		$this->assertEquals ( $expected, $result );
	}
	
	public function testGivenIntegerFieldThenNotePropertiesAreSet() {
		$result = self::INTEGER_FIELD;
		$result = $this->logic->initNoteFieldProperties ($result);
		
		$expected = [
				'valueType' => self::INTEGER_FIELD ['valueType'],
				'valueNumber' => self::INTEGER_FIELD ['valueNumber'],
				'valueField' => self::getValueField(self::INTEGER_FIELD),
				'noteField' => self::getNoteField(self::INTEGER_FIELD),
				'min' => self::INTEGER_MIN_MAX ['vmin'],
				'max' => self::INTEGER_MIN_MAX ['vmax']
		];
	
		$this->assertEquals ( $expected, $result );
	}
	
	public function testGivenBooleanFieldThenNotePropertiesAreSet() {
		$result = self::BOOLEAN_FIELD;
		$result = $this->logic->initNoteFieldProperties ($result);
		
		$expected = [
				'valueType' => self::BOOLEAN_FIELD ['valueType'],
				'valueNumber' => self::BOOLEAN_FIELD ['valueNumber'],
				'valueField' => self::getValueField(self::BOOLEAN_FIELD),
				'noteField' => self::getNoteField(self::BOOLEAN_FIELD),
				'min' => self::BOOLEAN_MIN_MAX ['vmin'],
				'max' => self::BOOLEAN_MIN_MAX ['vmax']
		];
	
		$this->assertEquals ( $expected, $result );
	}
	
	public function testGivenStringFieldThenNotePropertiesAreSet() {
		$result = self::SINGLE_ENUM_FIELD;
		$result = $this->logic->initNoteFieldProperties ($result);
		
		$expected = [
				'valueType' => self::SINGLE_ENUM_FIELD ['valueType'],
				'valueNumber' => self::SINGLE_ENUM_FIELD ['valueNumber'],
				'valueField' => self::getValueField(self::SINGLE_ENUM_FIELD),
				'noteField' => self::getNoteField(self::SINGLE_ENUM_FIELD),
				'min' => self::SINGLE_ENUM_MIN,
				'max' => self::SINGLE_ENUM_MAX
		];
	
		$this->assertEquals ( $expected, $result );
	}
	
	

	public function testGivenDecimalFieldThenComparePropertiesAreSet() {
		$result = self::DECIMAL_FIELD;
		$result = $this->logic->initCompareFieldProperties ($result);
		
		$expected = [
				'valueType' => self::DECIMAL_FIELD ['valueType'],
				'valueNumber' => self::DECIMAL_FIELD ['valueNumber'],
				'valueField' => self::getValueField(self::DECIMAL_FIELD),
				'min' => self::DECIMAL_MIN_MAX ['vmin'],
				'max' => self::DECIMAL_MIN_MAX ['vmax']
		];
	
		$this->assertEquals ( $expected, $result );
	}
	
	
	
	private function getValueField($field) {
		return BenchmarkFieldDataBaseUtils::getValueFieldProperty($field['valueType'], $field['valueNumber']);
	}
	
	private function getNoteField($field) {
		return BenchmarkFieldDataBaseUtils::getNoteFieldProperty($field['valueType'], $field['valueNumber']);
	}
}
