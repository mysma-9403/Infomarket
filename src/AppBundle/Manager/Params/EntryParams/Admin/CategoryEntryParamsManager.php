<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\Category;
use AppBundle\Entity\Segment;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Admin\Main\SegmentRepository;

class CategoryEntryParamsManager extends EntryParamsManager {
	
	public function getTreeParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
		$routeParams = $params['routeParams'];
	
	
		$filter = $this->fm->createFromRequest($request, $params);
		$routeParams = array_merge($routeParams, $filter->getRequestValues());
	
		$filter = $this->fm->adaptToTreeView($filter, $params);
		$viewParams['entryFilter'] = $filter;
	
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		$entries = $categoryRepository->findSelected($filter);
		
		$viewParams['entries'] = $entries;
	
	
		$params['viewParams'] = $viewParams;
		$params['routeParams'] = $routeParams;
		return $params;
	}
	
	public function getRatingsParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		
		/** @var SegmentRepository $segmentRepository */
		$segmentRepository = $this->doctrine->getRepository(Segment::class);
		$segments = $segmentRepository->findFilterItems();
		$viewParams['segments'] = $segments;
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
}