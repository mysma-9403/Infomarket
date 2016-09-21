<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\SimpleEntityController;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class Product2Controller extends SimpleEntityController
{
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
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
	 * @param Request $request
	 */
	protected function initIndexParams(Request $request, $page)
	{
		$params = parent::initIndexParams($request, $page);
		
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		
		$segmentFilter = new SimpleEntityFilter($userRepository);
		$segmentFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
		
		$segments = $this->getParamList(Segment::class, $segmentFilter);
		
		$segment = $this->getParamByName($request, Segment::class, null);
		
		$params['segments'] = $segments;
		$params['segment'] = $segment;
		 
		return $params;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType()
	{
		return Product::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getEntityName()
	 */
	protected function getEntityName()
	{
		return 'product2';
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\SimpleEntityController::getEntityFilter()
	 */
	protected function getEntityFilter(Request $request)
	{
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
		
		$filter = new ProductFilter($userRepository, $categoryRepository, $brandRepository, $segmentRepository);
		$filter->setPublished(SimpleEntityFilter::TRUE_VALUES);
		 
		$category = $this->getParamByName($request, Category::class, null);
		if($category) {
			$filter->setCategories([$category]);
		}
		
		$segment = $this->getParamByName($request, Segment::class, null);
		if($segment) {
			$filter->setSegments([$segment]);
		}
		 
		return $filter;
	}
}
