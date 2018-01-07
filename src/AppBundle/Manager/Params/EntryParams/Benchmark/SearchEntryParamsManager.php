<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Filter\Common\Search\BrandCategorySearchFilter;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utils\Lists\ListMerger;
use AppBundle\Repository\Search\Benchmark\BrandSearchRepository;
use AppBundle\Repository\Search\Benchmark\ProductSearchRepository;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Entity\Main\User;

// TODO make common class for IM, IP with repository creation hooks
class SearchEntryParamsManager extends EntryParamsManager {

	/**
	 * 
	 * @var CategoryRepository
	 */
	protected $categoryRepository;
	
	/**
	 *
	 * @var BrandSearchRepository
	 */
	protected $brandRepository;
	
	/**
	 *
	 * @var ProductSearchRepository
	 */
	protected $productRepository;
	
	/**
	 * 
	 * @var ListMerger
	 */
	protected $listMerger;

	public function __construct(EntityManager $em, FilterManager $fm, 
			BrandSearchRepository $brandRepository, ProductSearchRepository $productRepository, 
			CategoryRepository $categoryRepository, ListMerger $listMerger) {
		parent::__construct($em, $fm);
		
		$this->brandRepository = $brandRepository;
		$this->productRepository = $productRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->listMerger = $listMerger;
	}

	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
		
		$filter = new BrandCategorySearchFilter();
		$filter->initRequestValues($request);
		
		$categories = $this->categoryRepository->findIdsByUser($contextParams['user']);
		$filter->setCategories($categories);
		
		$brands = $this->brandRepository->findItems($filter);
		
		$products = $this->productRepository->findItems($filter);
		
		if (count($brands) > 0) {
			// TODO should be done by some array utils class
			$brandsIds = $this->brandRepository->getIds($brands);
			
			$filter->setBrands($brandsIds);
			
			if (count($products) < 8) {
				$products = $this->listMerger->merge($products, $this->productRepository->findItems($filter));
			}
		}
		
		$viewParams['products'] = $products;
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}