<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Advert;
use AppBundle\Entity\Branch;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Infomarket\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\HomeEntryParamsManager;
use AppBundle\Manager\Params\Infomarket\AdvertParamsManager;
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
		return new HomeEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getAdvertParamsManager() {
		$doctrine = $this->getDoctrine();
		$advertLocations = [Advert::FEATURED_LOCATION];
	
		return new AdvertParamsManager($doctrine, $advertLocations);
	}
	
	protected function getEntityManager($doctrine, $paginator) { 
		//TODO not needed change class hierarchy?
		return new CategoryManager($doctrine, $paginator);
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
