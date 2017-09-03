<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Main\Category;
use AppBundle\Filter\Infomarket\Base\BranchDependentFilter;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infomarket\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\CategoryEntryParamsManager;
use AppBundle\Manager\Params\Infomarket\CategoryAdvertParamsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Infomarket\BrandRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
use AppBundle\Repository\Infomarket\ProductRepository;
use AppBundle\Repository\Infomarket\SegmentRepository;

class CategoryController extends InfomarketController {
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Controller\Infomarket\HomeController::indexAction()
	 */
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param unknown $id        	
	 */
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$brandRepository = $this->get(BrandRepository::class);
		$categoryRepository = $this->get(CategoryRepository::class);
		$productRepository = $this->get(ProductRepository::class);
		$segmentRepository = $this->get(SegmentRepository::class);
		return new CategoryEntryParamsManager($em, $fm, $brandRepository, $categoryRepository, 
				$productRepository, $segmentRepository);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(CategoryManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new BranchDependentFilter());
	}

	protected function getAdvertParamsManager() {
		return $this->get(CategoryAdvertParamsManager::class);
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEntityType() {
		return Category::class;
	}
}
