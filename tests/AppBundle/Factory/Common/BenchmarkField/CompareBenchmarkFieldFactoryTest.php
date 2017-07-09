<?php

namespace Tests\AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Factory\Common\BenchmarkField\CompareBenchmarkFieldFactory;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use PHPUnit\Framework\TestCase;

class CompareBenchmarkFieldFactoryTest extends TestCase {
	
	const CATEGORY_ID = 100;
	
	const VALUE_FIELD = 'valueField';

	
	const DECIMAL_FIELD = [
			'fieldType' => BenchmarkField::DECIMAL_FIELD_TYPE,
			'valueNumber' => 11
	];
	const DECIMAL_MIN_MAX = [ 
			'vmin' => 3.75,
			'vmax' => 17.5 
	];
	const DECIMAL_EXPECTED = [
			'fieldType' => self::DECIMAL_FIELD ['fieldType'],
			'valueNumber' => self::DECIMAL_FIELD ['valueNumber'],
			'valueField' => self::VALUE_FIELD,
			'min' => self::DECIMAL_MIN_MAX ['vmin'],
			'max' => self::DECIMAL_MIN_MAX ['vmax']
	];
	
	
	
	public function testGivenDecimalThenPropertiesAreSet() {
		$logic = new CompareBenchmarkFieldFactory(
				$this->getBenchmarkFieldDataBaseUtilsMock(),
				$this->getDecimalRepositoryMock());
		
		$result = $logic->create(self::DECIMAL_FIELD, self::CATEGORY_ID);
		
		$this->assertEquals(self::DECIMAL_EXPECTED, $result);
	}
	
	
	
	private function getBenchmarkFieldDataBaseUtilsMock() {
		$repository = $this->getMockBuilder(BenchmarkFieldDataBaseUtils::class)
		->disableOriginalConstructor()->getMock();
	
		$repository->expects($this->once())
		->method('getValueFieldProperty')
		->willReturn(self::VALUE_FIELD);
	
		return $repository;
	}
	
	private function getDecimalRepositoryMock() {
		$repository = $this->getMockBuilder ( ProductRepository::class )->disableOriginalConstructor ()->getMock ();
	
		$repository->expects ( $this->once() )->method ( 'findMinMaxValues' )->willReturn(self::DECIMAL_MIN_MAX);
	
		return $repository;
	}
}
