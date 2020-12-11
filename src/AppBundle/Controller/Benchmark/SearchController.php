<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Benchmark\Base\BenchmarkStandardController;
use AppBundle\Entity\Main\Product;
use AppBundle\Filter\Common\Search\SearchFilter;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infomarket\SearchManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\SearchEntryParamsManager;
use AppBundle\Repository\Search\Benchmark\BrandSearchRepository;
use AppBundle\Repository\Search\Benchmark\ProductSearchRepository;
use AppBundle\Utils\Lists\ItemListMerger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Benchmark\CategoryRepository;

class SearchController extends BenchmarkStandardController {
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	public function indexAction(Request $request) {
		return $this->indexActionInternal($request, 1);
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$brandRepository = $this->get(BrandSearchRepository::class);
		$productRepository = $this->get(ProductSearchRepository::class);
		$categoryRepository = $this->get(CategoryRepository::class);
		
		$listMerger = $this->get(ItemListMerger::class);
		
		return new SearchEntryParamsManager($em, $fm, $brandRepository, $productRepository, $categoryRepository, 
				$listMerger);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(SearchManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new SearchFilter());
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEntityType() {
		return Product::class;
	}

	protected function getEntityName() {
		return 'search';
	}
}
