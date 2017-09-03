<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Main\Category;
use AppBundle\Repository\Infomarket\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Infomarket\AdvertRepository;

class CategoryAdvertParamsManager extends AdvertParamsManager {

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $categoryRepository;

	public function __construct(AdvertRepository $advertRepository, array $advertLocations, 
			CategoryRepository $categoryRepository) {
		parent::__construct($advertRepository, $advertLocations);
		
		$this->categoryRepository = $categoryRepository;
	}

	protected function getContextCategories(Request $request, $contextParams, $viewParams) {
		$category = $request->get('id');
		
		if ($category) {
			$categories = $this->categoryRepository->findContextParents($category);
			$categories = array_merge($categories, $this->categoryRepository->findContextChildren($category));
			$this->checkInRoots = false;
		} else {
			$categories = parent::getContextCategories($request, $contextParams, $viewParams);
			$this->checkInRoots = true;
		}
		
		return $categories;
	}
}