<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\SimpleEntityController;
use AppBundle\Entity\Brand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\BrandFilter;
use AppBundle\Entity\Category;

class BrandController extends ProductController
{	
	/**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityType()
     */
    protected function getEntityType()
    {
    	return Brand::class;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityFilter()
     */
    protected function getEntityFilter(Request $request)
    {
    	$filter = new BrandFilter();
    	$filter->setPublished(true);
    	
    	$category = $this->getParam($request, Category::class);
    	if($category) {
    		$filter->setCategories([$category]);
    	}
    	
    	return $filter;
    }
}
