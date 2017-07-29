<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Factory\Common\Choices\Enum\BenchmarkFieldBetterThanTypesFactory;
use PHPUnit\Framework\TestCase;

class BenchmarkFieldBetterThanTypesFactoryTest extends TestCase {
	
	const INVALID_VALUE = -1;
	
	const TWIG_FUNCTION = 'benchmarkFieldBetterThanTypeName';
	
	/**
	 * 
	 * @var BenchmarkFieldBetterThanTypesFactory
	 */
	protected $factory;
	
	
	
	protected function setUp() {
		$this->factory = new BenchmarkFieldBetterThanTypesFactory();
	}
	
	
	
	public function testGetFunctions() {
		$result = $this->factory->getFunctions();
	
		$this->assertArrayHasKey(self::TWIG_FUNCTION, $result);
	}
	
	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(BenchmarkField::GT_BETTER_THAN_TYPE, $result);
		$this->assertContains(BenchmarkField::LT_BETTER_THAN_TYPE, $result);
		$this->assertContains(BenchmarkField::NONE_BETTER_THAN_TYPE, $result);
	}
	
	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
	
		$this->assertFalse($result);
	}
}
