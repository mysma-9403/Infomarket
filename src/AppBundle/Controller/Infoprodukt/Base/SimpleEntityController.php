<?php

namespace AppBundle\Controller\Infoprodukt\Base;

use AppBundle\Entity\Base\SimpleEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
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
     * @see \AppBundle\Controller\Base\BaseEntityController::createNewFilter()
     */
    protected function getEntityFilter(Request $request) {
    	$filter = parent::getEntityFilter($request);
    	
    	$filter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	
    	return $filter;
    }
}
