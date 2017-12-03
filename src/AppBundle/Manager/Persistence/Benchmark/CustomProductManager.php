<?php

namespace AppBundle\Manager\Persistence\Benchmark;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Entity\Other\ProductScore;
use AppBundle\Entity\Other\ProductValue;
use AppBundle\Manager\Persistence\Base\PersistenceManager;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

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
	 *
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::saveMore()
	 *
	 * @param Product $item        	
	 */
	protected function saveMore(Request $request, $item, $persistent, array $params) {
		if (! $persistent) {
			$contextParams = $params['contextParams'];
			$subcategory = $contextParams['subcategory'];
			
			$assignment = $this->createProductCategoryAssignment($item, $subcategory);
			$this->em->persist($assignment);
			
			$value = $this->createProductValue($assignment);
			$this->em->persist($value);
			
			$score = $this->createProductScore($assignment);
			$this->em->persist($score);
			
			$note = $this->createProductNote($assignment);
			$this->em->persist($note);
		}
	}

	protected function createProductCategoryAssignment(Product $product, $categoryId) {
		$category = $this->categoryRepository->find($categoryId);
		
		$assignment = new ProductCategoryAssignment();
		$assignment->setProduct($product);
		$assignment->setCategory($category);
		$assignment->setOrderNumber(99);
		$assignment->setFeatured(false);
		
		return $assignment;
	}

	protected function createProductValue(ProductCategoryAssignment $assignment) {
		$value = new ProductValue();
		$value->setProductCategoryAssignment($assignment);
		
		return $value;
	}

	protected function createProductScore(ProductCategoryAssignment $assignment) {
		$score = new ProductScore();
		$score->setProductCategoryAssignment($assignment);
		$score->setUpToDate(false);
		
		return $score;
	}

	protected function createProductNote(ProductCategoryAssignment $assignment) {
		$note = new ProductNote();
		$note->setProductCategoryAssignment($assignment);
		$note->setOveralNote(2.0); // TODO first note should be calculated here!
		$note->setUpToDate(false);
		
		return $note;
	}
}