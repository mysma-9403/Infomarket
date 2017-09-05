<?php

namespace Tests\AppBundle\Form\Transformer;

use AppBundle\Entity\Base\Simple;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EntityToNumberTransformerTest extends TestCase {
	
	const INVALID_ID = -1;
	
	const ENTITY_ID = 100;
	const ENTITY_NAME = 'Simple name';
	
	
	
	public function testGivenNullEntityThenInvalidIdReturned() {
		$transformer = new EntityToNumberTransformer($this->getDummyRepositoryMock());
		
		$result = $transformer->transform(null);
		
		$this->assertEquals(self::INVALID_ID, $result);
	}
	
	public function testGivenEntityThenEntityIdReturned() {
		$transformer = new EntityToNumberTransformer($this->getDummyRepositoryMock());
	
		$entity = $this->getEntity();
		$result = $transformer->transform($entity);
	
		$this->assertEquals($entity->getId(), $result);
	}
	
	public function testGivenInvalidIdThenExceptionThrown() {
		$transformer = new EntityToNumberTransformer($this->getInvalidRepositoryMock());
		
		$this->expectException(TransformationFailedException::class);
		
		$transformer->reverseTransform(self::INVALID_ID);
	}
	
	public function testGivenEntityIdThenEntityReturned() {
		$transformer = new EntityToNumberTransformer($this->getValidRepositoryMock());
	
		$result = $transformer->reverseTransform(self::ENTITY_ID);
		
		$this->assertEquals($this->getEntity(), $result);
	}
	
	
	
	private function getDummyRepositoryMock() {
		$mock = $this->getMockBuilder ( EntityRepository::class )->disableOriginalConstructor ()->getMock ();
	
		return $mock;
	}
	
	private function getValidRepositoryMock() {
		$mock = $this->getMockBuilder ( EntityRepository::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->once())->method ( 'find' )->willReturn($this->getEntity());
	
		return $mock;
	}
	
	private function getInvalidRepositoryMock() {
		$mock = $this->getMockBuilder ( EntityRepository::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->once())->method ( 'find' )->willReturn(null);
	
		return $mock;
	}
	
	private function getEntity() {
		$entity = new Simple();
		$entity->setId(self::ENTITY_ID);
		$entity->setName(self::ENTITY_NAME);
		
		return $entity;
	}
}
