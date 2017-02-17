<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\Category;
use AppBundle\Entity\Segment;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Admin\Main\SegmentRepository;
use AppBundle\Repository\Admin\Main\CategoryRepository;

class CategoryEntryParamsManager extends EntryParamsManager {
	
	public function getTreeParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
	
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		$entries = $categoryRepository->findTreeItems();
		
		$viewParams['entries'] = $entries;
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
	
	public function getRatingsParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		
		/** @var SegmentRepository $segmentRepository */
		$segmentRepository = $this->doctrine->getRepository(Segment::class);
		$segments = $segmentRepository->findTopItems();
		$viewParams['segments'] = $segments;
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
}