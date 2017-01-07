<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Segment;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;

class CategoryEntryParamsManager extends EntryParamsManager {
	
	public function getTreeParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
		$routeParams = $params['routeParams'];
	
	
		$filter = $this->fm->createFromRequest($request, $params);
		$routeParams = array_merge($routeParams, $filter->getValues()); //TODO getValues -> getParams?
	
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
		
		$userRepository = $this->doctrine->getRepository(User::class);
		$segmentRepository = $this->doctrine->getRepository(Segment::class);
		
		
		$segmentFilter = new BaseEntityFilter($userRepository);
		
		$segments = $segmentRepository->findSelected($segmentFilter);
		$viewParams['segments'] = $segments;
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
}