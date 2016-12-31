<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\InfomarketController;
use AppBundle\Entity\Page;
use AppBundle\Manager\Entity\Common\PageManager;
use AppBundle\Manager\Filter\Common\PageFilterManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends InfomarketController
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
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		return new PageManager($doctrine, $paginator);
	}
	
	protected function getEntryFilterManager($doctrine) {
		return new PageFilterManager($doctrine);
	}
	
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	/**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityType()
     */
    protected function getEntityType()
    {
    	return Page::class;
    }
    
    //---------------------------------------------------------------------------
    // Routes
    //---------------------------------------------------------------------------
    
    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Base\BaseEntityController::getIndexRoute()
     */
    protected function getIndexRoute()
    {
    	return $this->getDomain() . '_home';
    }
}