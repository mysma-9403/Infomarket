<?php

namespace Tests\AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Form\FormBuilder\BenchmarkFilterFieldBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkFilterFieldBuilderTest extends TestCase {
	
	const DECIMAL_FIELD = [
			'valueField' => 'decimal1',
			'filterName' => 'Super price',
			'fieldType' => BenchmarkField::DECIMAL_FIELD_TYPE
	];
	
	const INTEGER_FIELD = [
			'valueField' => 'integer12',
			'filterName' => 'Num of wheels',
			'fieldType' => BenchmarkField::INTEGER_FIELD_TYPE
	];
	
	const BOOLEAN_FIELD = [
			'valueField' => 'integer3',
			'filterName' => 'Has super power',
			'fieldType' => BenchmarkField::BOOLEAN_FIELD_TYPE
	];
	
	const STRING_FIELD = [
			'valueField' => 'string7',
			'filterName' => 'More info',
			'fieldType' => BenchmarkField::STRING_FIELD_TYPE
	];
	
	const OPTIONS = [
			'choices' => [],
			'booleanChoices' => []
	];
	
	/**
	 * 
	 * @var BenchmarkFilterFieldBuilder
	 */
	protected $fieldBuilder;
	
	/**
	 * 
	 * @var FormBuilderInterface
	 */
	protected $builder;
	
	
	
	protected function setUp() {
		$this->fieldBuilder = new BenchmarkFilterFieldBuilder();
		$this->builder = $this->getBuilderMock();
	}
	
	
	
	public function testGivenDecimalThenFieldIsAdded() {
		$this->fieldBuilder->add($this->builder, self::DECIMAL_FIELD, self::OPTIONS);
	}
	
	public function testGivenIntegerThenFieldIsAdded() {
		$this->fieldBuilder->add($this->builder, self::INTEGER_FIELD, self::OPTIONS);
	}
	
	public function testGivenBooleanThenFieldIsAdded() {
		$this->fieldBuilder->add($this->builder, self::BOOLEAN_FIELD, self::OPTIONS);
	}
	
	public function testGivenStringThenFieldIsAdded() {
		$this->fieldBuilder->add($this->builder, self::STRING_FIELD, self::OPTIONS);
	}
	
	
	
	private function getBuilderMock() {
		$mock = $this->getMockBuilder ( FormBuilderInterface::class )->disableOriginalConstructor ()->getMock ();
		
		$mock->expects ($this->atLeastOnce())->method ( 'add' );
	
		return $mock;
	}
}
