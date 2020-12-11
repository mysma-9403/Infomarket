<?php

namespace Tests\AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Factory\Common\BenchmarkField\NoteBenchmarkFieldFactory;
use AppBundle\Repository\Benchmark\ProductRepository;
use PHPUnit\Framework\TestCase;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;

class NoteBenchmarkFieldFactoryTest extends TestCase {

	const CATEGORY_ID = 100;

	const VALUE_FIELD = 'valueField';

	const NOTE_FIELD = 'noteField';

	const DECIMAL_FIELD = ['fieldType' => BenchmarkField::DECIMAL_FIELD_TYPE, 'valueNumber' => 11];

	const DECIMAL_MIN_MAX = ['vmin' => 3.75, 'vmax' => 17.5];

	const DECIMAL_EXPECTED = ['fieldType' => self::DECIMAL_FIELD['fieldType'], 
			'valueNumber' => self::DECIMAL_FIELD['valueNumber'], 'valueField' => self::VALUE_FIELD, 
			'noteField' => self::NOTE_FIELD, 'min' => self::DECIMAL_MIN_MAX['vmin'], 
			'max' => self::DECIMAL_MIN_MAX['vmax']];

	const SINGLE_ENUM_FIELD = ['fieldType' => BenchmarkField::SINGLE_ENUM_FIELD_TYPE, 'valueNumber' => 3];

	const SINGLE_ENUM_MIN = 10;

	const SINGLE_ENUM_MAX = 75;

	const SINGLE_ENUM_EXPECTED = ['fieldType' => self::SINGLE_ENUM_FIELD['fieldType'], 
			'valueNumber' => self::SINGLE_ENUM_FIELD['valueNumber'], 'valueField' => self::VALUE_FIELD, 
			'noteField' => self::NOTE_FIELD, 'min' => self::SINGLE_ENUM_MIN, 'max' => self::SINGLE_ENUM_MAX];

	public function testGivenDecimalThenPropertiesAreSet() {
		$logic = new NoteBenchmarkFieldFactory($this->getBenchmarkFieldDataBaseUtilsMock(), 
				$this->getDecimalRepositoryMock());
		
		$result = $logic->create(self::DECIMAL_FIELD, self::CATEGORY_ID);
		
		$this->assertEquals(self::DECIMAL_EXPECTED, $result);
	}

	public function testGivenSingleEnumThenPropertiesAreSet() {
		$logic = new NoteBenchmarkFieldFactory($this->getBenchmarkFieldDataBaseUtilsMock(), 
				$this->getEnumRepositoryMock());
		
		$result = $logic->create(self::SINGLE_ENUM_FIELD, self::CATEGORY_ID);
		
		$this->assertEquals(self::SINGLE_ENUM_EXPECTED, $result);
	}

	private function getBenchmarkFieldDataBaseUtilsMock() {
		$repository = $this->getMockBuilder(BenchmarkFieldDataBaseUtils::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->once())->method('getValueFieldProperty')->willReturn(self::VALUE_FIELD);
		
		$repository->expects($this->once())->method('getNoteFieldProperty')->willReturn(self::NOTE_FIELD);
		
		return $repository;
	}

	private function getDecimalRepositoryMock() {
		$repository = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->once())->method('findMinMaxValues')->willReturn(self::DECIMAL_MIN_MAX);
		
		return $repository;
	}

	private function getEnumRepositoryMock() {
		$repository = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->once())->method('findMaxEnumValue')->willReturn(self::SINGLE_ENUM_MAX);
		
		$repository->expects($this->once())->method('findMinEnumValue')->willReturn(self::SINGLE_ENUM_MIN);
		
		return $repository;
	}
}
