<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\MagazineCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Magazine;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class MagazineCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var MagazineCategoryAssignment $entry */
		
		$entry->setMagazine($this->paramsManager->getParamByClass($request, Magazine::class));
		$entry->setCategory($this->paramsManager->getParamByClass($request, Category::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var MagazineCategoryAssignment $entry */
		
		$entry->setMagazine($template->getMagazine());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}

	protected function getEntityType() {
		return MagazineCategoryAssignment::class;
	}
}