<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\SimpleEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends SimpleEntityController
{
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
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType()
	{
		return Branch::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityFilter()
	 */
    protected function getEntityFilter(Request $request)
    {
    	$filter = parent::getEntityFilter($request);
    	$filter->setOrderBy('e.orderNumber ASC, e.name ASC');
    	
    	return $filter;	
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Base\BaseEntityController::createNewFilter()
     */
    protected function createNewFilter() {
    	$userRepository = $this->getDoctrine()->getRepository(User::class);
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    	return new BranchFilter($userRepository, $categoryRepository);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Base\BaseEntityController::getEntityName()
     */
    protected function getEntityName()
    {
    	return 'home';
    }
}
