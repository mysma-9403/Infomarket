<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\InfoproduktController;
use AppBundle\Entity\Category;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infoprodukt\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\HomeEntryParamsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends InfoproduktController
{
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	/**
	 * 
	 * @param Request $request
	 */
	public function indexAction(Request $request)
	{
		return $this->indexActionInternal($request, 1);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new HomeEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new CategoryManager($doctrine, $paginator);
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
    	return 'home';
    }
}
