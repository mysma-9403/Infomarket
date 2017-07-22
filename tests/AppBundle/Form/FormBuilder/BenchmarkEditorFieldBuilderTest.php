<?php

namespace Tests\AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Form\FormBuilder\BenchmarkEditorFieldBuilder;
use AppBundle\Form\Transformer\NumberToBooleanTransformer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkEditorFieldBuilderTest extends TestCase {
	
	const DECIMAL_FIELD = [
			'valueField' => 'decimal1',
			'fieldName' => 'Super price',
			'fieldType' => BenchmarkField::DECIMAL_FIELD_TYPE
	];
	
	const INTEGER_FIELD = [
			'valueField' => 'integer12',
			'fieldName' => 'Num of wheels',
			'fieldType' => BenchmarkField::INTEGER_FIELD_TYPE
	];
	
	const BOOLEAN_FIELD = [
			'valueField' => 'integer3',
			'fieldName' => 'Has super power',
			'fieldType' => BenchmarkField::BOOLEAN_FIELD_TYPE
	];
	
	const STRING_FIELD = [
			'valueField' => 'string7',
			'fieldName' => 'More info',
			'fieldType' => BenchmarkField::STRING_FIELD_TYPE
	];
	
	/**
	 * 
	 * @var BenchmarkEditorFieldBuilder
	 */
	protected $fieldBuilder;
	
	/**
	 * 
	 * @var FormBuilderInterface
	 */
	protected $builder;
	
	public function __construct() {
		$this->fieldBuilder = new BenchmarkEditorFieldBuilder($this->getDummyTransformerMock());
		$this->builder = $this->getBuilderMock();
	}
	
	//TODO test also if attributes are added
	
	public function testGivenDecimalThenFieldIsAdded() {
		$this->fieldBuilder->add($this->builder, self::DECIMAL_FIELD);
	}
	
	public function testGivenIntegerThenFieldIsAdded() {
		$this->fieldBuilder->add($this->builder, self::INTEGER_FIELD);
	}
	
	public function testGivenBooleanThenFieldIsAdded() {
		$this->fieldBuilder->add($this->builder, self::BOOLEAN_FIELD);
	}
	
	public function testGivenStringThenFieldIsAdded() {
		$this->fieldBuilder->add($this->builder, self::STRING_FIELD);
	}
	
	
	
	private function getDummyTransformerMock() {
		$mock = $this->getMockBuilder ( NumberToBooleanTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		return $mock;
	}
	
	private function getBuilderMock() {
		$repository = $this->getMockBuilder ( FormBuilderInterface::class )->disableOriginalConstructor ()->getMock ();
		
		$repository->expects ($this->once())->method ( 'add' );
		
		$repository->expects ($this->any())->method ( 'get' )->willReturn($this->getChildBuilderMock());
	
		return $repository;
	}
	
	private function getChildBuilderMock() {
		$repository = $this->getMockBuilder ( FormBuilderInterface::class )->disableOriginalConstructor ()->getMock ();
	
		$repository->expects ($this->any())->method ( 'addModelTransformer' );
	
		return $repository;
	}
}
