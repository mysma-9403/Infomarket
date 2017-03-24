<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Category;
use AppBundle\Repository\Infomarket\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class CategoryAdvertParamsManager extends AdvertParamsManager {
	
	public function __construct($doctrine, array $advertLocations) {
		parent::__construct($doctrine, $advertLocations);
	}
	
	protected function getContextCategories(Request $request, $contextParams, $viewParams) {
		$category = $request->get('id');
		
		if($category) {
			$em = $this->doctrine->getManager();
			$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
			
			$categories = $categoryRepository->findContextParents($category);
			$categories = array_merge($categories, $categoryRepository->findContextChildren($category));
			$this->checkInRoots = false;
		} else {
			$categories = parent::getContextCategories($request, $contextParams, $viewParams);
			$this->checkInRoots = true;
		}
		
		return $categories;
	}
}