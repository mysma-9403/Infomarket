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
			$valueField = $valueField = BenchmarkField::getValueTypeDBName($fields[$i]['valueType']) . $fields[$i]['valueNumber'];
			$fields[$i]['valueField'] = $valueField;
			
			switch($fields[$i]['fieldType']) {
				case BenchmarkField::DECIMAL_FIELD_TYPE:
				case BenchmarkField::INTEGER_FIELD_TYPE:
				case BenchmarkField::BOOLEAN_FIELD_TYPE:
					$value = $entry->offsetGet($valueField);
					
					$noteType = $fields[$i]['noteType'];
					$noteWeight = $fields[$i]['noteWeight'];
					if($noteType != BenchmarkField::NONE_NOTE_TYPE) {
						$minMaxValues = $productRepository->findMinMaxValues($categoryId, $valueField);
						
						$min = $minMaxValues['vmin'];
						$max = $minMaxValues['vmax'];
						
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
						$fields[$i]['note'] = $note;
						
						$overalNote += $note * $noteWeight;
						$overalCount += $noteWeight;
					} else {
						$fields[$i]['note'] = null;
					}
					
					$betterThanType = $fields[$i]['betterThanType'];
					if($betterThanType != BenchmarkField::NONE_BETTER_THAN_TYPE) {
						$totalCount = $productRepository->findItemsCount($categoryId, $valueField);
						$betterThanCount = $productRepository->findBetterThanCount($categoryId, $valueField, $value, $betterThanType);
						if($totalCount > 0) {
							$fields[$i]['betterThan'] = 100. * $betterThanCount / $totalCount;
						} else {
							$fields[$i]['betterThan'] = 100.;
						}
					} else {
						$fields[$i]['betterThan'] = null;
					}
					break;
			}
		}
		$viewParams['benchmarkFields'] = $fields;
		
		if($overalCount > 0) {
			$overalNote /= $overalCount;
		} else {
			$overalNote = 5.;
		}
		
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
			
			$field = $logic->initValueField($field);
			
			$weight = $field['compareWeight'];
			if($weight > 0) {
				switch($field['fieldType']) {
					case BenchmarkField::DECIMAL_FIELD_TYPE:
					case BenchmarkField::INTEGER_FIELD_TYPE:
					case BenchmarkField::BOOLEAN_FIELD_TYPE:			
						$minMaxValues = $productRepository->findMinMaxValues($categoryId, $field['valueField']);
						$field['min'] = $minMaxValues['vmin'];
						$field['max'] = $minMaxValues['vmax'];
				}
			}
			
			$fields[$i] = $field;
		}
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
	
	protected function getBenchmarkMessage($productId) {
		$authorId = $this->tokenStorage->getToken()->getUser()->getId();
		
		$em = $this->doctrine->getManager();
		
		$benchmarkMessageRepository = new BenchmarkMessageRepository($em, $em->getClassMetadata(BenchmarkMessage::class));
		$benchmarkMessages = $benchmarkMessageRepository->findItemsByAuthorAndProduct($authorId, $productId);
		
		return count($benchmarkMessages) > 0 ? $benchmarkMessages[0] : null;
	}
}