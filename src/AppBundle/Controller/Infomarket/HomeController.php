<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Advert;
use AppBundle\Entity\Branch;
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

class HomeController extends InfomarketController
{
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(Request $request)
	{
		return $this->indexActionInternal($request, 1);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$articleRepository = $this->get(ArticleRepository::class);
		$articleCategoryRepository = $this->get(ArticleCategoryRepository::class);
		$brandRepository = $this->get(BrandRepository::class);
		$magazineRepository = $this->get(MagazineRepository::class);
		$abaManager = $this->get(ArticleBrandAssignmentsManager::class);
		
		return new HomeEntryParamsManager($em, $fm, $articleRepository, 
				$articleCategoryRepository, $brandRepository, $magazineRepository, $abaManager);
	}
	
	protected function getAdvertParamsManager() {
		return $this->get('app.manager.param.infomarket.advert.featured');
	}
	
	protected function getEntityManager($doctrine, $paginator) { 
		//TODO not needed change class hierarchy - as its not used
		return $this->get(CategoryManager::class);
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function getEntityType()
	{
		return Branch::class;
	}
	
    protected function getEntityName()
    {
    	return 'home';
    }
}
