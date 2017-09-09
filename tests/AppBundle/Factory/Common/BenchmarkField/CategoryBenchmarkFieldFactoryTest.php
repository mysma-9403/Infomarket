<?php

namespace Tests\AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Factory\Common\BenchmarkField\CategoryBenchmarkFieldFactory;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use PHPUnit\Framework\TestCase;

class CategoryBenchmarkFieldFactoryTest extends TestCase {

	const CATEGORY_ID = 100;

	const VALUE_FIELD = 'valueField';

	const PRICE_VALUE_FIELD = 'price';

	const DECIMAL_FIELD = ['fieldType' => BenchmarkField::DECIMAL_FIELD_TYPE, 'valueNumber' => 11];

	const DECIMAL_MIN_MAX_AVG = ['vmin' => 3.75, 'vmax' => 17.5, 'vavg' => 7.67];

	const DECIMAL_VALUE_COUNTS = [[self::VALUE_FIELD => 1.0, 'vcount' => 1], 
			[self::VALUE_FIELD => 3.0, 'vcount' => 1], [self::VALUE_FIELD => 4.0, 'vcount' => 4], 
			[self::VALUE_FIELD => 8.0, 'vcount' => 2]];

	const DECIMAL_ALL_VALUES = [[self::VALUE_FIELD => 1.0], [self::VALUE_FIELD => 3.0], 
			[self::VALUE_FIELD => 4.0], [self::VALUE_FIELD => 4.0], [self::VALUE_FIELD => 4.0], 
			[self::VALUE_FIELD => 4.0], [self::VALUE_FIELD => 8.0], [self::VALUE_FIELD => 8.0]];
 // TODO min, max, mode and mean can be calculated from this!
	const DECIMAL_EXPECTED = ['fieldType' => self::DECIMAL_FIELD['fieldType'], 
			'valueNumber' => self::DECIMAL_FIELD['valueNumber'], 'valueField' => self::VALUE_FIELD, 
			'min' => self::DECIMAL_MIN_MAX_AVG['vmin'], 'max' => self::DECIMAL_MIN_MAX_AVG['vmax'], 
			'mean' => self::DECIMAL_MIN_MAX_AVG['vavg'], 'counts' => self::DECIMAL_VALUE_COUNTS, 'mode' => 4.0, 
			'median' => 4.0];

	const PRICE_FIELD = ['fieldType' => BenchmarkField::DECIMAL_FIELD_TYPE, 'valueField' => 'price'];

	const PRICE_MIN_MAX_AVG = ['vmin' => 3.75, 'vmax' => 17.5, 'vavg' => 7.67];

	const PRICE_VALUE_COUNTS = [[self::PRICE_VALUE_FIELD => 1.0, 'vcount' => 1], 
			[self::PRICE_VALUE_FIELD => 3.0, 'vcount' => 1], [self::PRICE_VALUE_FIELD => 4.0, 
					'vcount' => 4], [self::PRICE_VALUE_FIELD => 8.0, 'vcount' => 2]];

	const PRICE_ALL_VALUES = [[self::PRICE_VALUE_FIELD => 1.0], [self::PRICE_VALUE_FIELD => 3.0], 
			[self::PRICE_VALUE_FIELD => 4.0], [self::PRICE_VALUE_FIELD => 4.0], 
			[self::PRICE_VALUE_FIELD => 4.0], [self::PRICE_VALUE_FIELD => 4.0], 
			[self::PRICE_VALUE_FIELD => 8.0], [self::PRICE_VALUE_FIELD => 8.0]];
 // TODO min, max, mode and mean can be calculated from this!
	const PRICE_EXPECTED = ['fieldType' => self::PRICE_FIELD['fieldType'], 
			'valueField' => self::PRICE_FIELD['valueField'], 'min' => self::PRICE_MIN_MAX_AVG['vmin'], 
			'max' => self::PRICE_MIN_MAX_AVG['vmax'], 'mean' => self::PRICE_MIN_MAX_AVG['vavg'], 
			'counts' => self::PRICE_VALUE_COUNTS, 'mode' => 4.0, 'median' => 4.0];

	const BOOLEAN_FIELD = ['fieldType' => BenchmarkField::BOOLEAN_FIELD_TYPE, 'valueNumber' => 11];

	const BOOLEAN_COUNT = 132;

	const BOOLEAN_EXPECTED = ['fieldType' => self::BOOLEAN_FIELD['fieldType'], 
			'valueNumber' => self::BOOLEAN_FIELD['valueNumber'], 'valueField' => self::VALUE_FIELD, 
			'count' => self::BOOLEAN_COUNT];

	const MULTI_ENUM_FIELD = ['fieldType' => BenchmarkField::MULTI_ENUM_FIELD_TYPE, 'valueNumber' => 3];

	const MULTI_ENUM_ENUM_VALUES = [['one, two'], ['one'], ['one, two, three'], ['four']];

	const MULTI_ENUM_VALUES = 'one, two, three, four';

	const MULTI_ENUM_COUNTS = ['one' => 3, 'two' => 2, 'three' => 1, 'four' => 1];

	const MULTI_ENUM_EXPECTED = ['fieldType' => self::MULTI_ENUM_FIELD['fieldType'], 
			'valueNumber' => self::MULTI_ENUM_FIELD['valueNumber'], 'valueField' => self::VALUE_FIELD, 
			'values' => self::MULTI_ENUM_VALUES, 'valueCounts' => self::MULTI_ENUM_COUNTS];
	
	// TODO warunki brzegowe - co jak enum values zwroci pusty wynik
	public function testGivenDecimalThenPropertiesAreSet() {
		$logic = new CategoryBenchmarkFieldFactory($this->getBenchmarkFieldDataBaseUtilsMock(), 
				$this->getDecimalRepositoryMock());
		
		$result = $logic->create(self::DECIMAL_FIELD, self::CATEGORY_ID);
		
		$this->assertEquals(self::DECIMAL_EXPECTED, $result);
	}

	public function testGivenPriceThenPropertiesAreSet() {
		$logic = new CategoryBenchmarkFieldFactory($this->getPriceBenchmarkFieldDataBaseUtilsMock(), 
				$this->getPriceRepositoryMock());
		
		$result = $logic->create(self::PRICE_FIELD, self::CATEGORY_ID);
		
		$this->assertEquals(self::PRICE_EXPECTED, $result);
	}

	public function testGivenBooleanThenPropertiesAreSet() {
		$logic = new CategoryBenchmarkFieldFactory($this->getBenchmarkFieldDataBaseUtilsMock(), 
				$this->getBooleanRepositoryMock());
		
		$result = $logic->create(self::BOOLEAN_FIELD, self::CATEGORY_ID);
		
		$this->assertEquals(self::BOOLEAN_EXPECTED, $result);
	}

	public function testGivenMultiEnumThenPropertiesAreSet() {
		$logic = new CategoryBenchmarkFieldFactory($this->getBenchmarkFieldDataBaseUtilsMock(), 
				$this->getEnumRepositoryMock());
		
		$result = $logic->create(self::MULTI_ENUM_FIELD, self::CATEGORY_ID);
		
		$this->assertEquals(self::MULTI_ENUM_EXPECTED, $result);
	}

	private function getBenchmarkFieldDataBaseUtilsMock() {
		$repository = $this->getMockBuilder(BenchmarkFieldDataBaseUtils::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->once())->method('getValueFieldProperty')->willReturn(self::VALUE_FIELD);
		
		return $repository;
	}

	private function getPriceBenchmarkFieldDataBaseUtilsMock() {
		$repository = $this->getMockBuilder(BenchmarkFieldDataBaseUtils::class)->disableOriginalConstructor()->getMock();
		
		return $repository;
	}

	private function getDecimalRepositoryMock() {
		$repository = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->once())->method('findMinMaxAvgValues')->willReturn(
				self::DECIMAL_MIN_MAX_AVG);
		
		$repository->expects($this->once())->method('findValueCounts')->willReturn(self::DECIMAL_VALUE_COUNTS);
		
		$repository->expects($this->once())->method('findAllValues')->willReturn(self::DECIMAL_ALL_VALUES);
		
		return $repository;
	}

	private function getPriceRepositoryMock() {
		$repository = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->once())->method('findMinMaxAvgValues')->willReturn(self::PRICE_MIN_MAX_AVG);
		
		$repository->expects($this->once())->method('findValueCounts')->willReturn(self::PRICE_VALUE_COUNTS);
		
		$repository->expects($this->once())->method('findAllValues')->willReturn(self::PRICE_ALL_VALUES);
		
		return $repository;
	}

	private function getBooleanRepositoryMock() {
		$repository = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->once())->method('findItemsCount')->willReturn(self::BOOLEAN_COUNT);
		
		return $repository;
	}

	private function getEnumRepositoryMock() {
		$repository = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->once())->method('findEnumValues')->willReturn(self::MULTI_ENUM_ENUM_VALUES);
		
		return $repository;
	}
}
