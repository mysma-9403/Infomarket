<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Benchmark\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BenchmarkField;

class CategoryParamsManager extends EntryParamsManager {
	
	public function getShowParams(Request $request, array $params, $id) {
		if($id <= 0) {
			$id = $request->get('category', 0);
			
			if($id <= 0) {
				$id = $request->get('subcategory', 0);
				
				if($id <= 0) {
					$em = $this->doctrine->getManager();
					$repository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
				
					$items = $repository->findFilterItems();
					if(count($items) > 0) {
						$id = $items[key($items)];
					}
				}
			}
		}
		
    	$params = parent::getShowParams($request, $params, $id);
    	
    	$em = $this->doctrine->getManager();
    	
    	
    	$viewParams = $params['viewParams'];
    	
    	$segmentRepository = new SegmentRepository($em, $em->getClassMetadata(Segment::class));
    	$viewParams['segments'] = $segmentRepository->findItemsByCategory($id);
    	
    	
    	$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(Segment::class));
    	$productRepository = new ProductRepository($em, $em->getClassMetadata(Product::class));
    	
    	$numberFields = $benchmarkFieldRepository->findNumberItemsByCategory($id);
    	for ($i = 0; $i < count($numberFields); $i++) {
    		$fieldName = BenchmarkField::getValueTypeDBName($numberFields[$i]['valueType']) . $numberFields[$i]['valueNumber'];
    		$minMaxValues = $productRepository->findMinMaxValues($id, $fieldName);
    		$modeValues = $productRepository->findModeValues($id, $fieldName);
    		$meanValues = $productRepository->findMeanValues($id, $fieldName);
    		
    		$maxKey = null;
    		$maxValue = 0;
    		foreach ($modeValues as $modeValue) {
    			$key = $modeValue['mode'];
    			if($key > $maxKey) {
    				$maxKey = $key;
    				$maxValue = $modeValue[$fieldName];
    			}
    		}
    		
    		$meanValue = 0;
    		if(count($meanValues) > 0) {
	    		$halfIndex = count($meanValues) / 2;
	    		$meanValue = $meanValues[$halfIndex][$fieldName];
    		}
    		
    		$numberFields[$i]['min'] = $minMaxValues['vmin'];
    		$numberFields[$i]['max'] = $minMaxValues['vmax'];
    		$numberFields[$i]['mode'] = $maxValue;
    		$numberFields[$i]['median'] = $meanValue;
    		$numberFields[$i]['mean'] = $minMaxValues['vavg'];
    	}
    	$viewParams['numberFields'] = $numberFields;
    	
    	
    	$enumFields = $benchmarkFieldRepository->findEnumItemsByCategory($id);
    	for ($i = 0; $i < count($enumFields); $i++) {
    		$fieldName = BenchmarkField::getValueTypeDBName($enumFields[$i]['valueType']) . $enumFields[$i]['valueNumber'];
    		$values = $productRepository->findEnumValues($id, $fieldName);
    		$values = array_map('current', $values);
    		$items = [];
    		foreach ($values as $value) {
    			$singleValues = explode(", ", $value);
    			foreach ($singleValues as $singleValue) {
    				$items[$singleValue] = $singleValue;
    			}
    		}
    		$enumFields[$i]['values'] = join(", ", $items);
    	}
    	$viewParams['enumFields'] = $enumFields;
    	
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}