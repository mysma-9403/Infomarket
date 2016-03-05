<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\SimpleEntityController;
use AppBundle\Entity\Term;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\TermFilter;
use AppBundle\Entity\Category;

class TermController extends ProductController
{	
	/**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityType()
     */
    protected function getEntityType()
    {
    	return Term::class;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityFilter()
     */
    protected function getEntityFilter(Request $request)
    {
    	$filter = new TermFilter();
    	$filter->setPublished(true);
    	
    	$category = $this->getParam($request, Category::class);
    	if($category) {
    		$filter->setCategories([$category]);
    	}
    	 
    	return $filter;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getPageEntries()
     */
    protected function getPageEntries(Request $request)
    {
    	return 90;
    }
}
