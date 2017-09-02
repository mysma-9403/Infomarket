<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Logic\Benchmark\Fields\BenchmarkChartLogic;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Benchmark\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CategoryParamsManager extends EntryParamsManager {

	protected $chartLogic;

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 *
	 * @var ProductRepository
	 */
	protected $productRepository;

	/**
	 *
	 * @var SegmentRepository
	 */
	protected $segmentRepository;

	protected $benchmarkFieldsProvider;

	protected $benchmarkFieldsInitializer;

	protected $tokenStorage;

	public function __construct(EntityManager $em, FilterManager $fm, CategoryRepository $categoryRepository, ProductRepository $productRepository, SegmentRepository $segmentRepository, BenchmarkChartLogic $chartLogic, BenchmarkFieldsProvider $benchmarkFieldsProvider, BenchmarkFieldsInitializer $benchmarkFieldsInitializer, TokenStorage $tokenStorage) {
		parent::__construct($em, $fm);
		
		$this->productRepository = $productRepository;
		$this->categoryRepository = $categoryRepository;
		$this->segmentRepository = $segmentRepository;
		
		$this->chartLogic = $chartLogic;
		
		$this->benchmarkFieldsProvider = $benchmarkFieldsProvider;
		$this->benchmarkFieldsInitializer = $benchmarkFieldsInitializer;
		
		$this->tokenStorage = $tokenStorage;
	}

	public function getShowParams(Request $request, array $params, $id) {
		$id = $this->getCategoryId($request, $id);
		
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		/** @var Category $entry */
		$entry = $viewParams['entry'];
		
		if ($entry->getPreleaf()) {
			return $this->getShowCategoryParams($request, $params, $id);
		} else {
			return $this->getShowSubcategoryParams($request, $params, $id);
		}
	}

	protected function getCategoryId(Request $request, $id) {
		if ($id <= 0) {
			$id = $request->get('category', 0);
			
			if ($id <= 0) {
				$id = $request->get('subcategory', 0);
				
				if ($id <= 0) {
					$userId = $this->tokenStorage->getToken()->getUser()->getId();
					$items = $this->categoryRepository->findFilterItemsByUser($userId);
					if (count($items) > 0) {
						$id = $items[key($items)];
					}
				}
			}
		}
		
		return $id;
	}

	protected function getShowCategoryParams(Request $request, array $params, $id) {
		$viewParams = $params['viewParams'];
		
		$userId = $this->tokenStorage->getToken()->getUser()->getId();
		$subcategories = $this->categoryRepository->findFilterItemsByUserAndCategory($userId, $id);
		$viewParams['subcategories'] = $this->categoryRepository->findBy([ 
				'id' => $subcategories 
		]);
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	protected function getShowSubcategoryParams(Request $request, array $params, $id) {
		$viewParams = $params['viewParams'];
		
		$viewParams['segments'] = $this->segmentRepository->findItemsByCategory($id);
		$viewParams['numOfProducts'] = $this->productRepository->findItemsCount($id, 'id');
		
		$viewParams = $this->initBenchmarkFields($viewParams, $id);
		$viewParams = $this->initCharts($viewParams);
		
		$viewParams['bestProduct'] = $this->getBestProduct($id);
		$viewParams['worstProduct'] = $this->getWorstProduct($id);
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	protected function initBenchmarkFields($viewParams, $categoryId) {
		$viewParams['numberFields'] = $this->benchmarkFieldsInitializer->init($this->benchmarkFieldsProvider->getNumberFields($categoryId), $categoryId);
		$viewParams['enumFields'] = $this->benchmarkFieldsInitializer->init($this->benchmarkFieldsProvider->getEnumFields($categoryId), $categoryId);
		$viewParams['boolFields'] = $this->benchmarkFieldsInitializer->init($this->benchmarkFieldsProvider->getBoolFields($categoryId), $categoryId);
		
		$viewParams['priceField'] = $this->benchmarkFieldsInitializer->init([ 
				$this->benchmarkFieldsProvider->getPriceField() 
		], $categoryId)[0];
		
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