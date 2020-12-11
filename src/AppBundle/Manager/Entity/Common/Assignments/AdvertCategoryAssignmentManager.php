<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\AdvertCategoryAssignment;
use AppBundle\Entity\Main\Advert;
use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class AdvertCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var AdvertCategoryAssignment $entry */
		
		$entry->setAdvert($this->paramsManager->getParamByClass($request, Advert::class));
		$entry->setCategory($this->paramsManager->getParamByClass($request, Category::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var AdvertCategoryAssignment $entry */
		
		$entry->setAdvert($template->getAdvert());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}

	protected function getEntityType() {
		return AdvertCategoryAssignment::class;
	}
}