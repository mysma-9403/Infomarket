<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Entity\Product;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use Symfony\Component\HttpFoundation\Request;

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
	
	public function __construct($em, $fm, $doctrine, $tokenStorage,
			ProductRepository $productRepository,
			BenchmarkMessageRepository $benchmarkMessageRepository,
			BenchmarkFieldsProvider $benchmarkFieldsProvider,
			BenchmarkFieldsInitializer $showBenchmarkFieldsInitializer,
			BenchmarkFieldsInitializer $compareBenchmarkFieldsInitializer) {
		
		parent::__construct($em, $fm, $doctrine);
		
		$this->productRepository = $productRepository;
		$this->benchmarkMessageRepository = $benchmarkMessageRepository;
		
		$this->tokenStorage = $tokenStorage;
		
		$this->benchmarkFieldsProvider = $benchmarkFieldsProvider;
		
		$this->showBenchmarkFieldsInitializer = $showBenchmarkFieldsInitializer;
		$this->compareBenchmarkFieldsInitializer = $compareBenchmarkFieldsInitializer;
	}
	
	
	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		$viewParams = $params['viewParams'];
		$entries = $viewParams['entries'];
		
		for ($i = 0; $i < count($entries); $i++) {
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
		
		/** @var Product $entry */
		$entry = $viewParams['entry'];
		
		$assignment = $entry->getProductCategoryAssignments()->first();
		$categoryId = $assignment->getCategory()->getId();
		
		$overalNote = 0.;
		$overalCount = 0;
		
		$fields = $this->benchmarkFieldsProvider->getShowFields($categoryId);
		$fields = $this->showBenchmarkFieldsInitializer->init($fields, $categoryId);
		
		//TODO entire loop could be done in benchmarkFieldsInitializer
		for ($i = 0; $i < count($fields); $i++) {
			$field = $fields[$i];
			
			$valueField = $field['valueField'];
			$value = $entry->offsetGet($valueField);
			
			switch($field['fieldType']) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
				case BenchmarkField::INTEGER_FIELD_TYPE:
				case BenchmarkField::BOOLEAN_FIELD_TYPE:
					$noteType = $fields[$i]['noteType'];
					$noteWeight = $fields[$i]['noteWeight'];
					if($value && $noteType != BenchmarkField::NONE_NOTE_TYPE) {
						$min = $field['min'];
						$max = $field['max'];
						
						$note = 2.;
						if($max > $min) {
							if($noteType == BenchmarkField::ASC_NOTE_TYPE) {
								$note = 2. + 3. * ($value - $min) / ($max - $min);
							} else {
								$note = 2. + 3. * (1. - ($value - $min) / ($max - $min));
							}
						} else {
							$note = 5.;
						}
						$field['note'] = $note;
						
						$overalNote += $note * $noteWeight;
						$overalCount += $noteWeight;
					} else {
						$field['note'] = null;
					}
					
					$betterThanType = $fields[$i]['betterThanType'];
					if($value && $betterThanType != BenchmarkField::NONE_BETTER_THAN_TYPE) {
						$totalCount = $this->productRepository->findItemsCount($categoryId, $valueField);
						$betterThanCount = $this->productRepository->findBetterThanCount($categoryId, $valueField, $value, $betterThanType);
						if($totalCount > 0) {
							$field['betterThan'] = 100. * $betterThanCount / $totalCount;
						} else {
							$field['betterThan'] = 100.;
						}
					} else {
						$field['betterThan'] = null;
					}
					break;
				case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
				case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
					$noteType = $fields[$i]['noteType'];
					$noteWeight = $fields[$i]['noteWeight'];
					if($value && $noteType == BenchmarkField::ENUM_NOTE_TYPE) {
						$min = $field['min'];
						$max = $field['max'];
						
						$value = $this->productRepository->findEnumValue($entry->getId(), $valueField);
						
						//TODO what if $value == null?? note = 2.0??
						
						$note = 2.;
						if($max > $min) {
							if($noteType == BenchmarkField::ASC_NOTE_TYPE) {
								$note = 2. + 3. * ($value - $min) / ($max - $min);
							} else {
								$note = 5. - 3. * ($value - $min) / ($max - $min);
							}
						} else {
							$note = 5.;
						}
						$field['note'] = $note;
						
						$overalNote += $note * $noteWeight;
						$overalCount += $noteWeight;
					} else {
						$field['note'] = null;
					}
					break;
			}
			$fields[$i] = $field;
		}
		$viewParams['benchmarkFields'] = $fields;
		
		if($overalCount > 0) {
			$overalNote /= $overalCount;
		} else {
			$overalNote = 5.;
		}
		
		$overalNote = $entry->getProductNote()->getOveralNote();
		$viewParams['overalNote'] = $overalNote;
		
		
		$minMaxPrice = $this->productRepository->findMinMaxValues($categoryId, 'price');
		$minPrice = $minMaxPrice['vmin'];
		$maxPrice = $minMaxPrice['vmax'];
		
		if($maxPrice > $minPrice) {
			$viewParams['priceFactor'] = 2. + ($overalNote - 2.) * (1. - ($entry->getPrice() - $minPrice) / ($maxPrice - $minPrice));
		} else {
			$viewParams['priceFactor'] = 5.;
		}
		
		$viewParams['benchmarkMessage'] = $this->getBenchmarkMessage($id);
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}
	
	public function getCompareParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		$viewParams = $params['viewParams'];
		
		/** @var Product $entry */
		$entry = $viewParams['entry'];
		
		$assignment = $entry->getProductCategoryAssignments()->first();
		$categoryId = $assignment->getCategory()->getId();
		
		$fields = $this->benchmarkFieldsProvider->getShowFields($categoryId);
		$fields = $this->compareBenchmarkFieldsInitializer->init($fields, $categoryId);
		//TODO entire loop could be done in benchmarkFieldsInitializer
		for ($i = 0; $i < count($fields); $i++) {
			$field = $fields[$i];
			
			$valueField = $field['valueField'];
			$value = $entry->offsetGet($valueField);
			$weight = $field['compareWeight'];
			
			if($value && $weight > 0) {
				$fields[$i] = $field;
			} else {
				$fields[$i] = null;
			}
		}
		$fields = array_filter($fields, 'self::removeNull');
		$viewParams['benchmarkFields'] = $fields;
		
		
		$entries = $this->productRepository->findNeighbourItems($categoryId, $entry, $fields, 6);
		for ($i = 0; $i < count($entries); $i++) {
			$entry = $entries[$i];
			
			$entry['benchmarkMessage'] = $this->getBenchmarkMessage($entry['id']);
			
			$entries[$i] = $entry;
		}
		$viewParams['entries'] = $entries;
		
		$viewParams['benchmarkMessage'] = $this->getBenchmarkMessage($id);
		
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}
	
	protected function removeNull($value) {
		return $value !== null;
	}
	
	protected function getBenchmarkMessage($productId) {
		$authorId = $this->tokenStorage->getToken()->getUser()->getId();
		$benchmarkMessages = $this->benchmarkMessageRepository->findItemsByAuthorAndProduct($authorId, $productId);
		
		return count($benchmarkMessages) > 0 ? $benchmarkMessages[0] : null;
	}
}