<?php

namespace Tests\AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Factory\Common\BenchmarkField\SimpleBenchmarkFieldFactory;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use PHPUnit\Framework\TestCase;

class SimpleBenchmarkFieldFactoryTest extends TestCase {

	const CATEGORY_ID = 100;

	const VALUE_FIELD = 'valueField';

	const DECIMAL_FIELD = ['fieldType' => BenchmarkField::DECIMAL_FIELD_TYPE, 'valueNumber' => 11];

	const DECIMAL_EXPECTED = ['fieldType' => self::DECIMAL_FIELD['fieldType'], 
			'valueNumber' => self::DECIMAL_FIELD['valueNumber'], 'valueField' => self::VALUE_FIELD];

	public function testGivenFieldThenPropertiesAreSet() {
		$logic = new SimpleBenchmarkFieldFactory($this->getBenchmarkFieldDataBaseUtilsMock());
		
		$result = $logic->create(self::DECIMAL_FIELD, self::CATEGORY_ID);
		
		$this->assertEquals(self::DECIMAL_EXPECTED, $result);
	}

	private function getBenchmarkFieldDataBaseUtilsMock() {
		$repository = $this->getMockBuilder(BenchmarkFieldDataBaseUtils::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->once())->method('getValueFieldProperty')->willReturn(self::VALUE_FIELD);
		
		return $repository;
	}
}
