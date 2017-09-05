<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\Base\EntryParamsManager;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use AppBundle\Repository\Infoprodukt\MagazineRepository;
use Symfony\Component\HttpFoundation\Request;

class HomeEntryParamsManager extends EntryParamsManager {

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 *
	 * @var MagazineRepository
	 */
	protected $magazineRepository;

	public function __construct(EntityManager $em, FilterManager $fm, CategoryRepository $categoryRepository, 
			MagazineRepository $magazineRepository) {
		parent::__construct($em, $fm);
		
		$this->categoryRepository = $categoryRepository;
		$this->magazineRepository = $magazineRepository;
	}

	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		
		$viewParams['categories'] = $this->categoryRepository->findHomeItems();
		$viewParams['magazines'] = $this->magazineRepository->findHomeItems();
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}