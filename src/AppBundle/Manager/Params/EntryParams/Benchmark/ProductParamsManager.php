<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Logic\Common\BenchmarkField\Distribution\DistributionCalculator;
use AppBundle\Logic\Common\BenchmarkField\Distribution\ScoreDistributionCalculator;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Logic\Common\Product\NeighboursFinder\NeighboursFinder;

class ProductParamsManager extends EntryParamsManager {

	/**
	 *
	 * @var ProductRepository
	 */
	protected $productRepository;

	/**
	 *
	 * @var BenchmarkMessageRepository
	 */
	protected $benchmarkMessageRepository;

	protected $tokenStorage;

	/**
	 *
	 * @var BenchmarkFieldsProvider
	 */
	protected $benchmarkFieldsProvider;

	/**
	 *
	 * @var BenchmarkFieldsInitializer
	 */
	protected $showBenchmarkFieldsInitializer;

	/**
	 *
	 * @var BenchmarkFieldsInitializer
	 */
	protected $compareBenchmarkFieldsInitializer;

	/**
	 *
	 * @var DistributionCalculator
	 */
	private $distributionCalculator;

	/**
	 *
	 * @var ScoreDistributionCalculator
	 */
	private $scoreDistributionCalculator;

	/**
	 *
	 * @var NeighboursFinder
	 */
	private $neighboursFinder;

	public function __construct($em, $fm, $tokenStorage, ProductRepository $productRepository, 
			BenchmarkMessageRepository $benchmarkMessageRepository, 
			BenchmarkFieldsProvider $benchmarkFieldsProvider, 
			BenchmarkFieldsInitializer $showBenchmarkFieldsInitializer, 
			BenchmarkFieldsInitializer $compareBenchmarkFieldsInitializer, 
			DistributionCalculator $distributionCalculator, 
			ScoreDistributionCalculator $scoreDistributionCalculator, NeighboursFinder $neighboursFinder) {
		parent::__construct($em, $fm);
		
		$this->productRepository = $productRepository;
		$this->benchmarkMessageRepository = $benchmarkMessageRepository;
		
		$this->tokenStorage = $tokenStorage;
		
		$this->benchmarkFieldsProvider = $benchmarkFieldsProvider;
		
		$this->showBenchmarkFieldsInitializer = $showBenchmarkFieldsInitializer;
		$this->compareBenchmarkFieldsInitializer = $compareBenchmarkFieldsInitializer;
		
		$this->distributionCalculator = $distributionCalculator;
		$this->scoreDistributionCalculator = $scoreDistributionCalculator;
		
		$this->neighboursFinder = $neighboursFinder;
	}

	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		$viewParams = $params['viewParams'];
		$entries = $viewParams['entries'];
		
		for ($i = 0; $i < count($entries); $i ++) {
			$entry = $entries[$i];
			
			$entry['benchmarkMessage'] = $this->getBenchmarkMessage($entry['id']);
			
			$entries[$i] = $entry;
		}
		
		$viewParams['entries'] = $entries;
		$params['viewParams'] = $viewParams;
		return $params;
	}

	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
		
		/** @var Product $entry */
		$entry = $viewParams['entry'];
		$categoryId = $contextParams['subcategory'];
		
		$assignment = $this->getProductCategoryAssignment($entry, $categoryId);
		$productScore = $assignment->getProductScore();
		$productValue = $assignment->getProductValue();
		$productNote = $assignment->getProductNote();
		
		$fields = [];
		
		$category = $this->getMainCategory($assignment->getCategory());
		
		/** @var BenchmarkField $benchmarkField */
		foreach ($category->getBenchmarkFields() as $benchmarkField) {
			$field = [];
			
			$valueNumber = $benchmarkField->getValueNumber();
			$fieldType = $benchmarkField->getFieldType();
			
			switch ($fieldType) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
					$value = $productValue->offsetGet('decimal' . $valueNumber);
					$field['value'] = $value;
					$field['note'] = $productNote->offsetGet('decimalNote' . $valueNumber);
					
					$distribution = $this->distributionCalculator->calculate($benchmarkField);
					$field['betterThan'] = $this->getBetterThan($distribution, $value, $benchmarkField);
					break;
				case BenchmarkField::INTEGER_FIELD_TYPE:
				case BenchmarkField::BOOLEAN_FIELD_TYPE:
					$value = $productValue->offsetGet('integer' . $valueNumber);
					$field['value'] = $value;
					$field['note'] = $productNote->offsetGet('integerNote' . $valueNumber);
					
					$distribution = $this->distributionCalculator->calculate($benchmarkField);
					$field['betterThan'] = $this->getBetterThan($distribution, $value, $benchmarkField);
					break;
				case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
				case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
					$field['value'] = $productValue->offsetGet('string' . $valueNumber);
					$field['note'] = $productNote->offsetGet('stringNote' . $valueNumber);
					
					$score = $productScore->offsetGet('stringScore' . $valueNumber);
					$distribution = $this->scoreDistributionCalculator->calculate($benchmarkField);
					$field['betterThan'] = $this->getBetterThan($distribution, $score, $benchmarkField);
					break;
				case BenchmarkField::STRING_FIELD_TYPE:
					$field['value'] = $productValue->offsetGet('string' . $valueNumber);
					break;
			}
			
			$field['fieldType'] = $fieldType;
			$field['fieldName'] = $benchmarkField->getFieldName();
			$field['nullReplacement'] = $benchmarkField->getNullReplacement();
			$field['decimalPlaces'] = $benchmarkField->getDecimalPlaces();
			
			$fields[] = $field;
		}
		
		$viewParams['benchmarkFields'] = $fields;
		
		$overalNote = $productNote->getOveralNote();
		$viewParams['overalNote'] = $overalNote;
		
		if ($entry->getPrice() > 0) {
			// TODO replace by some non DB logic
			$minMaxPrice = $this->productRepository->findMinMaxValues($categoryId, 'price');
			$minPrice = $minMaxPrice['vmin'];
			$maxPrice = $minMaxPrice['vmax'];
			
			if ($maxPrice > $minPrice) {
				$viewParams['priceFactor'] = 2. +
						 ($overalNote - 2.) * (1. - ($entry->getPrice() - $minPrice) / ($maxPrice - $minPrice));
			} else {
				$viewParams['priceFactor'] = 5.;
			}
		} else {
			$viewParams['priceFactor'] = null;
		}
		
		$viewParams['benchmarkMessage'] = $this->getBenchmarkMessage($id);
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	protected function getBetterThan($distribution, $value, BenchmarkField $benchmarkField) {
		$better = 0;
		$all = 0;
		
		switch ($benchmarkField->getBetterThanType()) {
			case BenchmarkField::GT_BETTER_THAN_TYPE:
				foreach ($distribution as $key => $val) {
					if ($value > $key) {
						$better += $val;
					}
					$all += $val;
				}
				break;
			case BenchmarkField::LT_BETTER_THAN_TYPE:
				foreach ($distribution as $key => $val) {
					if ($value < $key) {
						$better += $val;
					}
					$all += $val;
				}
				break;
			default:
				return null;
		}
		
		return 100 * $better / $all;
	}

	/**
	 *
	 * @param Product $entry        	
	 * @param unknown $categoryId        	
	 *
	 * @return ProductCategoryAssignment
	 */
	protected function getProductCategoryAssignment(Product $entry, $categoryId) {
		$assignments = $entry->getProductCategoryAssignments();
		foreach ($assignments as $assignment) {
			if ($assignment->getCategory()->getId() == $categoryId) {
				return $assignment;
			}
		}
		foreach ($assignments as $assignment) {
			$mainCategory = $this->getMainCategory($assignment->getCategory());
			if ($mainCategory->getId() == $categoryId) {
				return $assignment;
			}
		}
		return $assignments->first();
	}

	/**
	 *
	 * @param Category $category        	
	 *
	 * @return Category
	 */
	protected function getMainCategory(Category $category) {
		while ($category->getParent()) {
			if ($category->getParent()->getPreleaf()) {
				return $category;
			}
			$category = $category->getParent();
		}
		
		return null;
	}

	public function getCompareParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		/** @var Product $entry */
		$entry = $viewParams['entry'];
		$categoryId = $contextParams['subcategory'];
		
		$assignment = $this->getProductCategoryAssignment($entry, $categoryId);
		
		$productValue = $assignment->getProductValue();
		$viewParams['productValue'] = $productValue;
		
		$category = $assignment->getCategory();
		
		$fields = $this->benchmarkFieldsProvider->getShowFields($this->getMainCategory($category));
		$fields = $this->compareBenchmarkFieldsInitializer->init($fields);
		
		// TODO entire loop could be done in benchmarkFieldsInitializer
		for ($i = 0; $i < count($fields); $i ++) {
			$field = $fields[$i];
			$value = $productValue->offsetGet($field['valueField']);
			$weight = $field['compareWeight'];
			
			if ($value && $weight > 0) {
				$fields[$i] = $field;
			} else {
				$fields[$i] = null;
			}
		}
		$fields = array_filter($fields, 'self::removeNull');
		$viewParams['benchmarkFields'] = $fields;
		
		$entries = $this->neighboursFinder->find($entry, $category, 6);
		$viewParams['entries'] = $entries;
		$viewParams['productValues'] = $this->getProductValues($entries, $category);
		
		$viewParams['benchmarkMessage'] = $this->getBenchmarkMessage($id);
		$viewParams['benchmarkMessages'] = $this->getBenchmarkMessages($entries);
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	private function getBenchmarkMessages(array $entries) {
		$result = [];
		
		/** @var Product $entry */
		foreach ($entries as $entry) {
			$id = $entry->getId();
			$result[$id] = $this->getBenchmarkMessage($id);
		}
		
		return $result;
	}

	private function getProductValues(array $entries, Category $category) {
		$result = [];
		
		/** @var Product $entry */
		foreach ($entries as $entry) {
			$id = $entry->getId();
			$assignment = $this->getProductCategoryAssignment($entry, $category->getId());
			$result[$id] = $assignment->getProductValue();
		}
		
		return $result;
	}

	protected function removeNull($value) {
		return $value !== null;
	}

	protected function getBenchmarkMessage($productId) {
		$authorId = $this->tokenStorage->getToken()->getUser()->getId();
		$benchmarkMessages = $this->benchmarkMessageRepository->findItemsByAuthorAndProduct($authorId, 
				$productId);
		
		return count($benchmarkMessages) > 0 ? $benchmarkMessages[0] : null;
	}
}