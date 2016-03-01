<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Infomarket\Base\SimpleEntityController;
use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Segment;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;

class ProductController extends SimpleEntityController
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
		
		$segmentFilter = new SimpleEntityFilter();
		$segments = $this->getParamList(Segment::class, $segmentFilter);
		
		$params['segments'] = $segments;
		 
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
}
