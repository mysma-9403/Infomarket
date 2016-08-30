<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Filter\PageFilter;
use AppBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class PageController extends SimpleEntityController
{   
	/**
	 * 
	 * @param Request $request
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
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityType()
	 */
    protected function getEntityType()
    {
    	return Page::class;
    }

    protected function createNewFilter()	
    {
    	$userRepository = $this->getDoctrine()->getRepository(User::class);
    	return new PageFilter($userRepository);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Base\BaseEntityController::getIndexRoute()
     */
    protected function getIndexRoute()
    {
    	return $this->getBaseName() . '_home';
    }
}
