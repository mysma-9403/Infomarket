<?php

namespace AppBundle\Manager\Persistence\Benchmark;

use AppBundle\Manager\Persistence\Base\PersistenceManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Main\Product;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Other\ProductNote;
use Doctrine\ORM\EntityManager;

class CustomProductManager extends PersistenceManager {
	
	/**
	 * 
	 * @var BaseRepository
	 */
	protected $categoryRepository;
	
	public function __construct(EntityManager $em, BaseRepository $categoryRepository) {
		parent::__construct($em);
		
		$this->categoryRepository = $categoryRepository;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::saveMore()
	 * 
	 * @param Product $item
	 */
	protected function saveMore(Request $request, $item, array $params) {
		$persistent = $this->getPersistentItem($item);
		if(!$persistent) {
			$contextParams = $params['contextParams'];
			$subcategory = $contextParams['subcategory'];
			
			$assignment = $this->createProductCategoryAssignment($item, $subcategory);
			$this->em->persist($assignment);
			
			$note = $this->createProductNote($assignment);
			$this->em->persist($note);
		}
	}
	
	protected function createProductCategoryAssignment(Product $product, Category $subcategory) {
		$category = $this->categoryRepository->find($subcategory);
		
		$assignment = new ProductCategoryAssignment();
		$assignment->setProduct($product);
		$assignment->setCategory($category);
		$assignment->setOrderNumber(99);
		$assignment->setFeatured(false);
		
		return $assignment;
	}
	
	protected function createProductNote(ProductCategoryAssignment $assignment) {
		$note = new ProductNote();
		$note->setProductCategoryAssignment($assignment);
		$note->setOveralNote(2.0); // TODO first note should be calculated here!
		$note->setUpToDate(false);
		
		return $note;
	}
}