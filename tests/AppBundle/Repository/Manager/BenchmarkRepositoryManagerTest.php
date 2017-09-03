<?php

namespace Tests\AppBundle\Repository\Manager;

use AppBundle\Entity\Main\Product;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Manager\BenchmarkRepositoryManager;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;

class BenchmarkRepositoryManagerTest extends TestCase {
	
	/**
	 * 
	 * @var BenchmarkRepositoryManager
	 */
	protected $manager;
	
	
	
	protected function setUp() {
		$this->manager = new BenchmarkRepositoryManager($this->getObjectManagerMock());
	}
	
	
	
	public function testProductRepository() {
		$result = $this->manager->getRepository(Product::class);
		
		$this->assertInstanceOf(ProductRepository::class, $result);
	}
	
	public function testInvalidRepository() {
		$result = $this->manager->getRepository(BenchmarkRepositoryManager::class);
		
		$this->assertNull($result);
	}
	
	
	
	private function getObjectManagerMock() {
		$mock = $this->createMock(ObjectManager::class);
		
		$mock->expects($this->atMost(1))->method('getClassMetadata')->willReturn($this->getClassMetadataMock());
		
		return $mock;
	}
	
	private function getClassMetadataMock() {
		return $this->createMock(ClassMetadata::class);
	}
}
