<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\CategoryFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Magazine;

class HomeController extends SimpleEntityController
{
	/**
	 * 
	 * @param Request $request
	 * @param unknown $page
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getShowParams()
	 */
	protected function getIndexParams(Request $request, $page)
	{
		$params = parent::getIndexParams($request, $page);
	
		$magazineFilter = new MagazineFilter();
		$magazineFilter->initValues($request);
		$magazineFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
		$magazineFilter->setFeatured(SimpleEntityFilter::TRUE_VALUES);
		$magazineFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
		$magazineFilter->setLimit(4);
	
		$magazines = $this->getParamList(Magazine::class, $magazineFilter);
		$params['magazines'] = $magazines;
	
		return $params;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\HomeController::getEntityType()
	 */
	protected function getEntityType()
	{
		return Category::class;
	}
	
	protected function getEntityFilter(Request $request)
	{
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		$filter = new CategoryFilter($branchRepository, $categoryRepository);
		$filter->setPublished(true);
		
		$category = $this->getParamById($request, Category::class, null);
		
		if($category) {
			$filter->setParents([$category]);
		}
		 
		return $filter;
	}
	
    protected function getEntityName()
    {
    	return 'home';
    }
}
