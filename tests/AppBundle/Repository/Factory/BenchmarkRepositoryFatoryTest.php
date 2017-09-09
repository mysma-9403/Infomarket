<?php

namespace Tests\AppBundle\Repository\Factory;

use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Factory\BenchmarkRepositoryFactory;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;

class BenchmarkRepositoryFatoryTest extends TestCase {

	/**
	 *
	 * @var BenchmarkRepositoryManager
	 */
	protected $factory;

	protected function setUp() {
		$this->factory = new BenchmarkRepositoryFactory($this->getObjectManagerMock());
	}

	public function testProductRepository() {
		$result = $this->factory->getRepository(ProductRepository::class);
		
		$this->assertInstanceOf(ProductRepository::class, $result);
	}

	public function testInvalidRepository() {
		$result = $this->factory->getRepository(BenchmarkRepositoryFactory::class);
		
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
