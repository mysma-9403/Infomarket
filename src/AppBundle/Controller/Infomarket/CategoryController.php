<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Category;
use AppBundle\Filter\Infomarket\Base\BranchDependentFilter;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infomarket\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\CategoryEntryParamsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends InfomarketController
{
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\HomeController::indexAction()
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new CategoryEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new CategoryManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new BranchDependentFilter());
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function getEntityType()
	{
		return Category::class;
	}
}
