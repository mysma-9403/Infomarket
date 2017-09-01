<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Category;
use AppBundle\Filter\Common\SearchFilter;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infomarket\SearchManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\SearchEntryParamsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Search\Infomarket\ArticleSearchRepository;
use AppBundle\Repository\Search\Infomarket\BrandSearchRepository;
use AppBundle\Repository\Search\Infomarket\ProductSearchRepository;
use AppBundle\Repository\Search\Infomarket\TermSearchRepository;

class SearchController extends InfomarketController {
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
		$articleRepository = $this->get(ArticleSearchRepository::class);
		$brandRepository = $this->get(BrandSearchRepository::class);
		$productRepository = $this->get(ProductSearchRepository::class);
		$termRepository = $this->get(TermSearchRepository::class);
		
		return new SearchEntryParamsManager($em, $fm, $articleRepository,
				$brandRepository, $productRepository, $termRepository);
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
		return Category::class;
	}

	protected function getEntityName() {
		return 'search';
	}
}
