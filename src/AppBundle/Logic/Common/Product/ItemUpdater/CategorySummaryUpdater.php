<?php

namespace AppBundle\Logic\Common\Product\ItemUpdater;

use AppBundle\Entity\Other\CategorySummary;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Repository\Benchmark\ProductRepository;

class CategorySummaryUpdater implements ItemUpdater {

	/**
	 * 
	 * @var ObjectManager
	 */
	protected $em;
	
	/**
	 * 
	 * @var ProductRepository
	 */
	protected $productRepository;
	
	public function __construct(ObjectManager $em, ProductRepository $productRepository) {
		$this->em = $em;
		$this->productRepository = $productRepository;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Logic\Common\Product\ItemUpdater\ItemUpdater::update()
	 * 
	 * @param CategorySummary $item 
	 */
	public function update($item) {
		$minMaxValues = $this->productRepository->findAllMinMaxValues($item->getCategory()->getId());
		
		$item = $this->updateMinMaxValues($item, $minMaxValues);
		$item->setUpToDate(true);
		
		$this->em->persist($item);
	}
	
	protected function updateMinMaxValues(CategorySummary $item, array $minMaxValues) {
		foreach ($minMaxValues as $key => $value) {
			$item->offsetSet($key, $value);
		}
		return $item;
	}
}