<?php

namespace AppBundle\Repository\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Entity\Product;

class BenchmarkRepositoryManager {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	public function __construct(ObjectManager $em) {
		$this->em = $em;
	}

	public function getRepository($className) {
		if ($className == Product::class) {
			return new ProductRepository($this->em, $this->em->getClassMetadata($className));
		}
		
		return null;
	}
}