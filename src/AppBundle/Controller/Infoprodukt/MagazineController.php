<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Entity\Magazine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MagazineController extends SimpleEntityController
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
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityType()
	 */
    protected function getEntityType()
    {
    	return Magazine::class;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityFilter()
     */
    protected function getEntityFilter(Request $request)
    {
    	$filter = new MagazineFilter();
    	$filter->initValues($request);
    	$filter->setPublished(SimpleEntityFilter::TRUE_VALUES);
    	
    	return $filter;
    }
}
