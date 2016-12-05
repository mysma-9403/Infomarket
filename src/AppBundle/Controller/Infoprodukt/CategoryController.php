<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\InfoproduktController;
use AppBundle\Entity\Category;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Filter\Infoprodukt\IPCategoryFilterManager;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\CategoryEntryParamsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends InfoproduktController
{
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------x
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
		$em = new CategoryManager($doctrine, $paginator);
		$em->setEntriesPerPage(0);
		return $em;
	}
	
	protected function getEntryFilterManager($doctrine) {
		return new IPCategoryFilterManager($doctrine);
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
}
