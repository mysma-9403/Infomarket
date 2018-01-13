<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
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

	/**
	 *
	 * @var BenchmarkFieldsProvider
	 */
	protected $benchmarkFieldsProvider;

	/**
	 *
	 * @var BenchmarkFieldsInitializer
	 */
	protected $benchmarkFieldsInitializer;

	protected $tokenStorage;

	public function __construct(EntityManager $em, FilterManager $fm, CategoryRepository $categoryRepository, 
			ProductRepository $productRepository, SegmentRepository $segmentRepository, 
			BenchmarkFieldsProvider $benchmarkFieldsProvider, 
			BenchmarkFieldsInitializer $benchmarkFieldsInitializer, TokenStorage $tokenStorage) {
		parent::__construct($em, $fm);
		
		$this->productRepository = $productRepository;
		$this->categoryRepository = $categoryRepository;
		$this->segmentRepository = $segmentRepository;
		
		$this->benchmarkFieldsProvider = $benchmarkFieldsProvider;
		$this->benchmarkFieldsInitializer = $benchmarkFieldsInitializer;
		
		$this->tokenStorage = $tokenStorage;
	}

	public function getShowParams(Request $request, array $params, $id) {
		$id = $this->getCategoryId($request, $params, $id);
		
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

	protected function getCategoryId(Request $request, array $params, $id) {
		if ($id <= 0) {
			$id = $request->get('category', 0);
			
			if ($id <= 0) {
				$id = $request->get('subcategory', 0);
				
				if ($id <= 0) {
					$id = $params['contextParams']['category'];
				}
			}
		}
		
		return $id;
	}

	protected function getShowCategoryParams(Request $request, array $params, $id) {
		$viewParams = $params['viewParams'];
		
		$userId = $this->tokenStorage->getToken()->getUser()->getId();
		$subcategories = $this->categoryRepository->findFilterItemsByUserAndCategory($userId, $id, true);
		$viewParams['subcategories'] = $this->categoryRepository->findBy(['id' => $subcategories]);
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	protected function getShowSubcategoryParams(Request $request, array $params, $id) {
		$viewParams = $params['viewParams'];
		
		$item = $viewParams['entry'];
		
		$viewParams['segments'] = $this->segmentRepository->findItemsByCategory($id);
		$viewParams['numOfProducts'] = $this->productRepository->findItemsCount($id, 'id');
		
		$viewParams = array_merge($viewParams, $this->initBenchmarkFields($item));
		
		$viewParams['bestProduct'] = $this->getBestProduct($id);
		$viewParams['worstProduct'] = $this->getWorstProduct($id);
		
		$params['viewParams'] = $viewParams;
		
		return $params;
	}

	protected function initBenchmarkFields(Category $item) {
		$result = [];
		
		// TODO make price field one of the others???
		// $result['priceField'] = $this->benchmarkFieldsInitializer->init(
		// [$this->benchmarkFieldsProvider->getPriceField()])[0];
		
		$result['numberFields'] = $this->benchmarkFieldsInitializer->init(
				$this->benchmarkFieldsProvider->getNumberFields($item));
		$result['enumFields'] = $this->benchmarkFieldsInitializer->init(
				$this->benchmarkFieldsProvider->getEnumFields($item));
		$result['boolFields'] = $this->benchmarkFieldsInitializer->init(
				$this->benchmarkFieldsProvider->getBoolFields($item));
		
		return $result;
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