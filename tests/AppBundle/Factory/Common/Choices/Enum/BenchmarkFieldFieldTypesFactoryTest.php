<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Factory\Common\Choices\Enum\BenchmarkFieldFieldTypesFactory;
use PHPUnit\Framework\TestCase;

class BenchmarkFieldFieldTypesFactoryTest extends TestCase {
	
	const INVALID_VALUE = -1;
	
	const TWIG_FUNCTION = 'benchmarkFieldFieldTypeName';
	
	/**
	 * 
	 * @var BenchmarkFieldFieldTypesFactory
	 */
	protected $factory;
	
	
	
	protected function setUp() {
		$this->factory = new BenchmarkFieldFieldTypesFactory();
	}
	
	
	
	public function testGetFunctions() {
		$result = $this->factory->getFunctions();
	
		$this->assertArrayHasKey(self::TWIG_FUNCTION, $result);
	}
	
	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(BenchmarkField::BOOLEAN_FIELD_TYPE, $result);
		$this->assertContains(BenchmarkField::DECIMAL_FIELD_TYPE, $result);
		$this->assertContains(BenchmarkField::INTEGER_FIELD_TYPE, $result);
		$this->assertContains(BenchmarkField::MULTI_ENUM_FIELD_TYPE, $result);
		$this->assertContains(BenchmarkField::SINGLE_ENUM_FIELD_TYPE, $result);
		$this->assertContains(BenchmarkField::STRING_FIELD_TYPE, $result);
	}
	
	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
	
		$this->assertFalse($result);
	}
}
