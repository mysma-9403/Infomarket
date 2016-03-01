<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\SimpleEntityController;
use AppBundle\Entity\Brand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OfficeController extends SimpleEntityController
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
		return $this->indexActionInternal($request, 0);
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
    	return Brand::class;
    }
    
    protected function getEntityName()
    {
    	return 'office';
    }
}

