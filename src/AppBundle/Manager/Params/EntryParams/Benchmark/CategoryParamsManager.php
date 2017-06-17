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
use AppBundle\Logic\Benchmark\Fields\BenchmarkChartLogic;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;

class CategoryParamsManager extends EntryParamsManager {
	
	protected $chartLogic;
	
	protected $productRepository;
	
	public function __construct(EntityManager $em, FilterManager $fm, $doctrine, BenchmarkChartLogic $chartLogic) {
		parent::__construct($em, $fm, $doctrine);
		
		$this->chartLogic = $chartLogic;
		
		//TODO refactor -> make Dependency Injection!!
		$emm = $this->doctrine->getManager();
		$this->productRepository = new ProductRepository($emm, $emm->getClassMetadata(Product::class));
	}
	
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
    	$viewParams = $this->initCharts($viewParams);
    	
    	$viewParams['bestProduct'] = $this->getBestProduct($id);
    	$viewParams['worstProduct'] = $this->getWorstProduct($id);
    	
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
	
	protected function initCharts($viewParams) {
		$viewParams = $this->initBoolCharts($viewParams);
		$viewParams = $this->initNumberCharts($viewParams);
		$viewParams = $this->initEnumCharts($viewParams);
		
		$viewParams = $this->initPriceChart($viewParams);
		
		return $viewParams;
	}
	
	protected function initBoolCharts($viewParams) {
		$numOfProducts = $viewParams['numOfProducts'];
		
		$boolFields = $viewParams['boolFields'];
		foreach ($boolFields as $key => $field) {
			$boolFields[$key] = $this->chartLogic->initChartForBooleanField($field, $numOfProducts);
		}
		$viewParams['boolFields'] = $boolFields;
		
		return $viewParams;
	}
	
	protected function initNumberCharts($viewParams) {
		$numberFields = $viewParams['numberFields'];
		foreach ($numberFields as $key => $field) {
			$numberFields[$key] = $this->chartLogic->initChartForNumberField($field);
		}
		$viewParams['numberFields'] = $numberFields;
	
		return $viewParams;
	}
	
	protected function initEnumCharts($viewParams) {
		$enumFields = $viewParams['enumFields'];
		foreach ($enumFields as $key => $field) {
			$enumFields[$key] = $this->chartLogic->initChartForEnumField($field);
		}
		$viewParams['enumFields'] = $enumFields;
	
		return $viewParams;
	}
	
	protected function initPriceChart($viewParams) {
		$priceField = $viewParams['priceField'];
		$priceField = $this->chartLogic->initChartForNumberField($priceField);
		
		$viewParams['priceField'] = $priceField;
	
		return $viewParams;
	}
	
	protected function getBestProduct($categoryId) {
		$product = $this->productRepository->findBestItem($categoryId);
		return $product['id'];
	}
	
	protected function getWorstProduct($categoryId) {
		$product = $this->productRepository->findWorstItem($categoryId);
		return $product['id'];
	}
}