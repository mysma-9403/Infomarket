<?php

namespace AppBundle\Manager\Persistence\Main;

use AppBundle\Entity\Main\BenchmarkQuery;
use AppBundle\Manager\Persistence\Base\PersistenceManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Factory\Filter\ProductFilterFactory;
use AppBundle\Entity\Main\Product;
use Doctrine\ORM\EntityManager;

class BenchmarkQueryManager extends PersistenceManager {

	/**
	 *
	 * @var ProductFilterFactory
	 */
	protected $productFilterFactory;

	/**
	 *
	 * @var BaseRepository
	 */
	protected $productRepository;

	public function __construct(EntityManager $em, ProductFilterFactory $productFilterFactory, 
			BaseRepository $productRepository) {
		parent::__construct($em);
		
		$this->productFilterFactory = $productFilterFactory;
		$this->productRepository = $productRepository;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::saveMore()
	 *
	 * @param BenchmarkQuery $item        	
	 */
	protected function saveMore(Request $request, $item, $persistent, array $params) {
		if (! $persistent && $item->getArchived()) {
			$this->productFilterFactory->create($request, $params);
			$products = $this->productRepository->findItems($this->productFilter);
			
			foreach ($products as $product) {
				/** @var Product $archived */
				$archived = $this->productRepository->find($product['id']);
				
				$this->em->detach($archived);
				
				$archived->clear();
				$archived->setBenchmarkQuery($item);
				
				$this->em->persist($archived);
			}
			$this->em->flush();
		}
	}
}