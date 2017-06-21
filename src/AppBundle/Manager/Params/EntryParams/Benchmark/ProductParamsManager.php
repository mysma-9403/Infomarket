<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Product;
use AppBundle\Logic\Benchmark\Fields\BenchmarkFieldLogic;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use AppBundle\Entity\BenchmarkMessage;

class ProductParamsManager extends EntryParamsManager {
	
	protected $tokenStorage;
	
	public function __construct($em, $fm, $doctrine, $tokenStorage) {
		parent::__construct($em, $fm, $doctrine);
		
		$this->tokenStorage = $tokenStorage;
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
		
		$em = $this->doctrine->getManager();
		
		$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
		$productRepository = new ProductRepository($em, $em->getClassMetadata(Product::class));
		
		$assignment = $entry->getProductCategoryAssignments()->first();
		$categoryId = $assignment->getCategory()->getId();
		
		$overalNote = 0.;
		$overalCount = 0;
		
		$fields = $benchmarkFieldRepository->findShowItemsByCategory($categoryId);
		for ($i = 0; $i < count($fields); $i++) {
// 			$valueField = $valueField = BenchmarkField::getValueTypeDBName($fields[$i]['valueType']) . $fields[$i]['valueNumber'];
// 			$fields[$i]['valueField'] = $valueField;

			$logic = new BenchmarkFieldLogic($productRepository, $categoryId);
			$field = $fields[$i];
			
			//TODO previous was better due to late DB query --> now throws exception!! :<
			$field = $logic->initNoteFieldProperties($field);
			$valueField = $field['valueField'];
			
			switch($field['fieldType']) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
				case BenchmarkField::INTEGER_FIELD_TYPE:
				case BenchmarkField::BOOLEAN_FIELD_TYPE:
					$value = $entry->offsetGet($valueField);
					
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
						$totalCount = $productRepository->findItemsCount($categoryId, $valueField);
						$betterThanCount = $productRepository->findBetterThanCount($categoryId, $valueField, $value, $betterThanType);
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
						
						$value = $productRepository->findEnumValue($entry->getId(), $valueField);
						
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
		
		
		$minMaxPrice = $productRepository->findMinMaxValues($categoryId, 'price');
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
		
		$em = $this->doctrine->getManager();
		
		$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
		$productRepository = new ProductRepository($em, $em->getClassMetadata(Product::class));
		
		$assignment = $entry->getProductCategoryAssignments()->first();
		$categoryId = $assignment->getCategory()->getId();
		
		$logic = new BenchmarkFieldLogic($productRepository, $categoryId);
		
		$fields = $benchmarkFieldRepository->findShowItemsByCategory($categoryId);
		for ($i = 0; $i < count($fields); $i++) {
			$field = $fields[$i];
			
			$field = $logic->initCompareFieldProperties($field);
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
		
		
		$entries = $productRepository->findNeighbourItems($categoryId, $entry, $fields, 5);
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
		
		$em = $this->doctrine->getManager();
		
		$benchmarkMessageRepository = new BenchmarkMessageRepository($em, $em->getClassMetadata(BenchmarkMessage::class));
		$benchmarkMessages = $benchmarkMessageRepository->findItemsByAuthorAndProduct($authorId, $productId);
		
		return count($benchmarkMessages) > 0 ? $benchmarkMessages[0] : null;
	}
}