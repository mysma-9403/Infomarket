<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Category;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Filter\Infomarket\IMSearchFilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\SearchEntryParamsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends InfomarketController
{
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\HomeController::indexAction()
	 */
	public function indexAction(Request $request)
	{
		return $this->indexActionInternal($request, 1);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new SearchEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new CategoryManager($doctrine, $paginator);
	}
	
	protected function getEntryFilterManager($doctrine) {
		return new IMSearchFilterManager($doctrine);
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\HomeController::getEntityType()
	 */
	protected function getEntityType()
	{
		return Category::class;
	}
	
	protected function getEntityName()
	{
		return 'search';
	}
}
