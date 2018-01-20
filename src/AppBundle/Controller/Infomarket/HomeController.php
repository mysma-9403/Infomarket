<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Main\Advert;
use AppBundle\Entity\Main\Branch;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infomarket\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\HomeEntryParamsManager;
use AppBundle\Manager\Utils\ArticleBrandAssignmentsManager;
use AppBundle\Repository\Infomarket\ArticleCategoryRepository;
use AppBundle\Repository\Infomarket\ArticleRepository;
use AppBundle\Repository\Infomarket\BrandRepository;
use AppBundle\Repository\Infomarket\MagazineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Infomarket\BranchRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Manager\Params\Infomarket\HomeContextParamsManager;
use AppBundle\Repository\Admin\Assignments\ProductCategoryAssignmentRepository;

class HomeController extends InfomarketController {
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	/**
	 *
	 * @param Request $request        	
	 * @param integer $page        	
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(Request $request) {
		return $this->indexActionInternal($request, 1);
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getContextParamsManager(Request $request) {
		$rm = new RouteManager();
		$lastRoute = $rm->getLastRoute($request, $this->getHomeRoute());
		$lastRouteParams = $lastRoute['routeParams'];
		
		if (! $lastRouteParams) {
			$lastRouteParams = array();
		}
		
		$articleCategoryRepository = $this->get(ArticleCategoryRepository::class);
		$branchRepository = $this->get(BranchRepository::class);
		$categoryRepository = $this->get(CategoryRepository::class);
		$productCategoryAssignmentRepository = $this->get(ProductCategoryAssignmentRepository::class);
		
		$paramManager = $this->get(ParamsManager::class);
		
		return new HomeContextParamsManager($articleCategoryRepository, $branchRepository, $categoryRepository, 
				$productCategoryAssignmentRepository, $paramManager, $lastRouteParams);
	}

	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$articleRepository = $this->get(ArticleRepository::class);
		$articleCategoryRepository = $this->get(ArticleCategoryRepository::class);
		$branchRepository = $this->get(BranchRepository::class);
		$brandRepository = $this->get(BrandRepository::class);
		$categoryRepository = $this->get(CategoryRepository::class);
		$magazineRepository = $this->get(MagazineRepository::class);
		$abaManager = $this->get(ArticleBrandAssignmentsManager::class);
		
		return new HomeEntryParamsManager($em, $fm, $articleRepository, $articleCategoryRepository, 
				$branchRepository, $brandRepository, $categoryRepository, $magazineRepository, $abaManager);
	}

	protected function getAdvertParamsManager() {
		return $this->get('app.manager.param.infomarket.advert.featured');
	}

	protected function getEntityManager($doctrine, $paginator) {
		// TODO not needed change class hierarchy - as its not used
		return $this->get(CategoryManager::class);
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEntityType() {
		return Branch::class;
	}

	protected function getEntityName() {
		return 'home';
	}
}
