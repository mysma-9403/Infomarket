<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Category;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryCategoryAssignment;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var MenuEntryCategoryAssignment $entry */
		
		$entry->setMenuEntry($this->paramsManager->getParamByClass($request, MenuEntry::class));
		$entry->setCategory($this->paramsManager->getParamByClass($request, Category::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var MenuEntryCategoryAssignment $entry */
		
		$entry->setMenuEntry($template->getMenuEntry());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}

	protected function getEntityType() {
		return MenuEntryCategoryAssignment::class;
	}
}