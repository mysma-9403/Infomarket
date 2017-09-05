<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use AppBundle\Repository\Admin\Main\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;

class CategoryEntryParamsManager extends EntryParamsManager {

	/** @var CategoryRepository */
	protected $categoryRepository;

	/** @var SegmentRepository */
	protected $segmentRepository;

	public function __construct(EntityManager $em, FilterManager $fm, CategoryRepository $categoryRepository, 
			SegmentRepository $segmentRepository) {
		parent::__construct($em, $fm);
		
		$this->categoryRepository = $categoryRepository;
		$this->segmentRepository = $segmentRepository;
	}

	public function getTreeParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
		
		$entries = $this->categoryRepository->findTreeItems();
		$viewParams['entries'] = $entries;
		
		$params['viewParams'] = $viewParams;
		return $params;
	}

	public function getRatingsParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		
		$segments = $this->segmentRepository->findTopItems();
		$viewParams['segments'] = $segments;
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}