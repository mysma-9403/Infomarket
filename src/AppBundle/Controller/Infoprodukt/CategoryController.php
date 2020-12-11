<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\InfoproduktController;
use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Analytics\AnalyticsManager;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infoprodukt\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\CategoryEntryParamsManager;
use AppBundle\Manager\Utils\ArticleBrandAssignmentsManager;
use Happyr\GoogleAnalyticsBundle\Service\Tracker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Infoprodukt\AdvertRepository;
use AppBundle\Repository\Infoprodukt\ArticleRepository;
use AppBundle\Repository\Infoprodukt\ArticleCategoryRepository;
use AppBundle\Repository\Infoprodukt\BrandRepository;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use AppBundle\Repository\Infoprodukt\ProductRepository;
use AppBundle\Repository\Infoprodukt\SegmentRepository;

class CategoryController extends InfoproduktController
{
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
    public function showAction(Request $request, $slug, $category = null) {
        return $this->showActionInternal($request, $slug, $category);
    }
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$advertRepository = $this->get(AdvertRepository::class);
		$articleRepository = $this->get(ArticleRepository::class);
		$articleCategoryRepository = $this->get(ArticleCategoryRepository::class);
		$brandRepository = $this->get(BrandRepository::class);
		$categoryRepository = $this->get(CategoryRepository::class);
		$productRepository = $this->get(ProductRepository::class);
		$segmentRepository = $this->get(SegmentRepository::class);
		
		$abaManager = $this->get(ArticleBrandAssignmentsManager::class);
		
		return new CategoryEntryParamsManager($em, $fm, $advertRepository, $articleRepository, 
				$articleCategoryRepository, $brandRepository, $categoryRepository, $productRepository, 
				$segmentRepository, $abaManager);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(CategoryManager::class);
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEntityType() {
		return Category::class;
	}
}
