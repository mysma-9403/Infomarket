<?php

namespace AppBundle\Controller\Base;

use AppBundle\Entity\Base\SimpleEntity;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class SimpleEntityController extends BaseEntityController
{   
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityType()
	 */
    protected function getEntityType()
    {
    	return SimpleEntity::class;
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
