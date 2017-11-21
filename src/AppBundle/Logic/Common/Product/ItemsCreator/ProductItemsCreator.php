<?php

namespace AppBundle\Logic\Common\Product\ItemsCreator;

use AppBundle\Repository\Admin\Assignments\ProductCategoryAssignmentRepository;
use AppBundle\Repository\Admin\Main\CategoryRepository;

class ProductItemsCreator {

	/**
	 *
	 * @var CategoryRepository
	 */
	private $categoryRepository;

	/**
	 *
	 * @var ProductCategoryAssignmentRepository
	 */
	private $productCategoryAssignmentRepository;

	/**
	 *
	 * @var DependentItemsCreator
	 */
	private $productValuesCreator;

	/**
	 *
	 * @var DependentItemsCreator
	 */
	private $productScoresCreator;

	/**
	 *
	 * @var DependentItemsCreator
	 */
	private $productNotesCreator;

	/**
	 *
	 * @var DependentItemsCreator
	 */
	private $categoryDistributionsCreator;

	/**
	 *
	 * @var DependentItemsCreator
	 */
	private $categorySummariesCreator;

	public function __construct(CategoryRepository $categoryRepository, 
			ProductCategoryAssignmentRepository $productCategoryAssignmentRepository, 
			DependentItemsCreator $productValuesCreator, DependentItemsCreator $productScoresCreator, 
			DependentItemsCreator $productNotesCreator, DependentItemsCreator $categoryDistributionsCreator, 
			DependentItemsCreator $categorySummariesCreator) {
		$this->productCategoryAssignmentRepository = $productCategoryAssignmentRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->productValuesCreator = $productValuesCreator;
		$this->productScoresCreator = $productScoresCreator;
		$this->productNotesCreator = $productNotesCreator;
		
		$this->categoryDistributionsCreator = $categoryDistributionsCreator;
		$this->categorySummariesCreator = $categorySummariesCreator;
	}

	public function createMissingItems() {
		$result = [];
		
		$result['categoryDistributions'] = $this->createCategoryDistributions();
		$result['categorySummaries'] = $this->createCategorySummaries();
		
		$result['productValues'] = $this->createProductValues();
		$result['productScores'] = $this->createProductScores();
		$result['productNotes'] = $this->createProductNotes();
		
		return $result;
	}

	private function createCategoryDistributions() {
		$categories = $this->categoryRepository->findItemsWithoutDistribution();
		return $this->categoryDistributionsCreator->createFrom($categories);
	}
	
	private function createCategorySummaries() {
		$categories = $this->categoryRepository->findItemsWithoutSummary();
		return $this->categorySummariesCreator->createFrom($categories);
	}

	private function createProductValues() {
		$assignments = $this->productCategoryAssignmentRepository->findItemsWithoutProductValue();
		return $this->productValuesCreator->createFrom($assignments);
	}

	private function createProductScores() {
		$assignments = $this->productCategoryAssignmentRepository->findItemsWithoutProductScore();
		return $this->productScoresCreator->createFrom($assignments);
	}

	private function createProductNotes() {
		$assignments = $this->productCategoryAssignmentRepository->findItemsWithoutProductNote();
		return $this->productNotesCreator->createFrom($assignments);
	}
}