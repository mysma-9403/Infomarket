<?php

namespace Tests\AppBundle\Logic\Common\BenchmarkField\Initializer;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Factory\Common\BenchmarkField\BenchmarkFieldFactory;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializerImpl;
use PHPUnit\Framework\TestCase;

class BenchmarkFieldsInitializerImplTest extends TestCase {

	const FIELDS = [[1], [2], [3]];

	const CATEGORY = 100;

	public function testGivenFieldsThenInitialized() {
		$initializer = new BenchmarkFieldsInitializerImpl($this->getBenchmarkFieldFactoryMock());
		
		$result = $initializer->init(self::FIELDS, self::CATEGORY);
		
		$this->assertNotEmpty($result);
	}

	private function getBenchmarkFieldFactoryMock() {
		$repository = $this->getMockBuilder(BenchmarkFieldFactory::class)->disableOriginalConstructor()->getMock();
		
		$repository->expects($this->exactly(count(self::FIELDS)))->method('create');
		
		return $repository;
	}
}
