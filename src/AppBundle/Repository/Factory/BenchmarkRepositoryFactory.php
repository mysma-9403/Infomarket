<?php

namespace AppBundle\Repository\Factory;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Repository\Benchmark\BenchmarkQueryRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\CustomProductRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;

class BenchmarkRepositoryFactory {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	public function __construct(ObjectManager $em) {
		$this->em = $em;
	}

	public function getRepository($class) {
		if ($class == BenchmarkMessageRepository::class) {
			return new BenchmarkMessageRepository($this->em, $this->em->getClassMetadata(BenchmarkMessage::class));
		}
		if ($class == BenchmarkQueryRepository::class) {
			return new BenchmarkQueryRepository($this->em, $this->em->getClassMetadata(BenchmarkQuery::class));
		}
		if ($class == CategoryRepository::class) {
			return new CategoryRepository($this->em, $this->em->getClassMetadata(Category::class));
		}
		if ($class == CustomProductRepository::class) {
			return new CustomProductRepository($this->em, $this->em->getClassMetadata(Product::class));
		}
		if ($class == ProductRepository::class) {
			return new ProductRepository($this->em, $this->em->getClassMetadata(Product::class));
		}
		
		return null;
	}
}