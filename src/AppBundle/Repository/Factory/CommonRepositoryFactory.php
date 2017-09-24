<?php

namespace AppBundle\Repository\Factory;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Repository\Common\BenchmarkFieldMetadataRepository;
use Doctrine\Common\Persistence\ObjectManager;

class CommonRepositoryFactory {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	public function __construct(ObjectManager $em) {
		$this->em = $em;
	}

	public function getRepository($class) {
		if ($class == BenchmarkFieldMetadataRepository::class) {
			return new BenchmarkFieldMetadataRepository($this->em, 
					$this->em->getClassMetadata(BenchmarkField::class));
		}
		
		return null;
	}
}