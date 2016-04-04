<?php

namespace AppBundle\Controller\Infoprodukt\Base;

use AppBundle\Entity\Base\SimpleEntity;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SimpleEntityController extends InfoproduktEntityController
{   
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityType()
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
