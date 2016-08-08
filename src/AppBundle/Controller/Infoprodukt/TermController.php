<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\TermFilter;
use AppBundle\Entity\Term;
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
    
    protected function getEntityFilter(Request $request)
    {
    	$filter = parent::getEntityFilter($request);
    
    	$category = $this->getParamById($request, Category::class, null);
    	if($category) {
    		$filter->setCategories([$category]);
    	}
    
    	return $filter;
    }
    
    protected function createNewFilter()
    {
    	$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
    	
    	return new TermFilter($categoryRepository);
    }
}
