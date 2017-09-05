<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\BrandCategoryAssignment;
use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class BrandCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var BrandCategoryAssignment $entry */
		
		$entry->setBrand($this->paramsManager->getParamByClass($request, Brand::class));
		$entry->setCategory($this->paramsManager->getParamByClass($request, Category::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var BrandCategoryAssignment $entry */
		
		$entry->setBrand($template->getBrand());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}

	protected function getEntityType() {
		return BrandCategoryAssignment::class;
	}
}