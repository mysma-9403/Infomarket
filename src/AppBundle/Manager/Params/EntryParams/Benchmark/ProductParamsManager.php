<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Product;
use AppBundle\Repository\Benchmark\ProductRepository;

class ProductParamsManager extends EntryParamsManager {
	
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
		
		$viewParams['priceFactor'] = 2. + ($overalNote - 2.) * (1. - ($entry->getPrice() - $minPrice) / ($maxPrice - $minPrice));
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}
	
	public function getCompareParams(Request $request, array $params, $id) {
    	return $this->getShowParams($request, $params, $id);
	}
}