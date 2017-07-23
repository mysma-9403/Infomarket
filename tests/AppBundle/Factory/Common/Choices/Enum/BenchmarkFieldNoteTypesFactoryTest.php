<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Factory\Common\Choices\Enum\BenchmarkFieldNoteTypesFactory;
use PHPUnit\Framework\TestCase;

class BenchmarkFieldNoteTypesFactoryTest extends TestCase {
	
	const INVALID_VALUE = -1;
	
	const TWIG_FUNCTION = 'benchmarkFieldNoteTypeName';
	
	/**
	 * 
	 * @var BenchmarkFieldNoteTypesFactory
	 */
	protected $factory;
	
	
	
	protected function setUp() {
		$this->factory = new BenchmarkFieldNoteTypesFactory();
	}
	
	
	
	public function testGetFunctions() {
		$result = $this->factory->getFunctions();
	
		$this->assertArrayHasKey(self::TWIG_FUNCTION, $result);
	}
	
	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(BenchmarkField::ASC_NOTE_TYPE, $result);
		$this->assertContains(BenchmarkField::DESC_NOTE_TYPE, $result);
		$this->assertContains(BenchmarkField::ENUM_NOTE_TYPE, $result);
		$this->assertContains(BenchmarkField::NONE_NOTE_TYPE, $result);
	}
	
	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
	
		$this->assertFalse($result);
	}
}
