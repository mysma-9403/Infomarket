<?php

namespace AppBundle\Manager\Params\EntryParams\Infomarket;

use AppBundle\Entity\Category;
use AppBundle\Entity\Segment;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\Base\EntryParamsManager;
use AppBundle\Repository\Infomarket\BrandRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
use AppBundle\Repository\Infomarket\ProductRepository;
use AppBundle\Repository\Infomarket\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;

class CategoryEntryParamsManager extends EntryParamsManager {

	/**
	 *
	 * @var BrandRepository
	 */
	protected $brandRepository;

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

	public function __construct(EntityManager $em, FilterManager $fm, BrandRepository $brandRepository, CategoryRepository $categoryRepository, ProductRepository $productRepository, SegmentRepository $segmentRepository) {
		parent::__construct($em, $fm);
		
		$this->brandRepository = $brandRepository;
		$this->categoryRepository = $categoryRepository;
		$this->productRepository = $productRepository;
		$this->segmentRepository = $segmentRepository;
	}

	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$viewParams['topBrands'] = $this->brandRepository->findTopItems($entry->getId());
		$viewParams['brands'] = $this->brandRepository->findRecommendedItems($entry->getId());
		
		$viewParams['segments'] = $segments = $this->segmentRepository->findTopItems();
		
		$viewParams['products'] = array ();
		
		foreach ($segments as $segment) {
			$products = $this->productRepository->findTopItems($entry->getId(), $segment['id']);
			$viewParams['products'][$segment['id']] = $products;
		}
		
		$categories = $this->categoryRepository->findSubcategories($entry->getId());
		$viewParams['subcategories'] = $categories;
		
		$viewParams['subproducts'] = array ();
		
		foreach ($categories as $category) {
			$viewParams['subproducts'][$category['id']] = array ();
			
			foreach ($segments as $segment) {
				$products = $this->productRepository->findTopItems($category['id'], $segment['id']);
				$viewParams['subproducts'][$category['id']][$segment['id']] = $products;
			}
		}
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}