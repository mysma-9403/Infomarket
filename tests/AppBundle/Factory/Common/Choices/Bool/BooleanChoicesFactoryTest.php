<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Factory\Common\Choices\Bool\BooleanChoicesFactory;
use AppBundle\Filter\Base\Filter;
use PHPUnit\Framework\TestCase;

class BooleanChoicesFactoryTest extends TestCase {
	
	const INVALID_VALUE = -1;
	
	/**
	 * 
	 * @var BooleanChoicesFactory
	 */
	protected $factory;
	
	
	
	protected function setUp() {
		$this->factory = new BooleanChoicesFactory();
	}
	
	
	
	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(Filter::ALL_VALUES, $result);
		$this->assertContains(Filter::TRUE_VALUES, $result);
		$this->assertContains(Filter::FALSE_VALUES, $result);
	}
	
	public function testGetAllValuesLabel() {
		$result = $this->factory->getItemLabel(Filter::ALL_VALUES);
	
		$this->assertNotNull($result);
	}
	
	public function testGetTrueValuesLabel() {
		$result = $this->factory->getItemLabel(Filter::TRUE_VALUES);
	
		$this->assertNotNull($result);
	}
	
	public function testGetFalseValuesLabel() {
		$result = $this->factory->getItemLabel(Filter::FALSE_VALUES);
	
		$this->assertNotNull($result);
	}
	
	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
	
		$this->assertFalse($result);
	}
}
