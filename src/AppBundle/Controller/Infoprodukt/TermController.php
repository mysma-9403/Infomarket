<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Term;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TermController extends SimpleEntityController
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
    	return Term::class;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityFilter()
     */
    protected function getEntityFilter(Request $request)
    {
    	$filter = new SimpleEntityFilter();
    	$filter->setPublished(true);
    	
    	return $filter;
    }
}
