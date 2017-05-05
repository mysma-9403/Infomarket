<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Logic\Benchmark\Fields\BenchmarkFieldsLogic;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Benchmark\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;

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
    	
    	$productRepository = new ProductRepository($em, $em->getClassMetadata(Product::class));
    	$viewParams['numOfProducts'] = $productRepository->findItemsCount($id, 'id');
    	
    	
    	$viewParams = $this->initBenchmarkFields($viewParams, $id);
    	
    	
    	$params['viewParams'] = $viewParams;
    	
    	return $params;
	}
	
	protected function initBenchmarkFields($viewParams, $categoryId) {
		$em = $this->doctrine->getManager();
		
		$benchmarkFieldRepository = new BenchmarkFieldRepository($em, $em->getClassMetadata(BenchmarkField::class));
		$productRepository = new ProductRepository($em, $em->getClassMetadata(Product::class));
		 
		$logic = new BenchmarkFieldsLogic($benchmarkFieldRepository, $productRepository, $categoryId);
		 
		$viewParams['numberFields'] = $logic->getBenchmarkNumberFields();
		$viewParams['enumFields'] = $logic->getBenchmarkEnumFields();
		$viewParams['boolFields'] = $logic->getBenchmarkBoolFields();
		
		$viewParams['priceField'] = $logic->getBenchmarkPriceField();
		
		return $viewParams;
	}
}