<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;

class HomeEntryParamsManager extends EntryParamsManager {

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $categoryRepository;

	public function __construct(EntityManager $em, FilterManager $fm, CategoryRepository $categoryRepository) {
		parent::__construct($em, $fm);
		
		$this->categoryRepository = $categoryRepository;
	}

	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		
		$viewParams['categories'] = $this->categoryRepository->findHomeItems();
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}