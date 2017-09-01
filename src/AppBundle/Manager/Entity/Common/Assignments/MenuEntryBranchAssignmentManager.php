<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Branch;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryBranchAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var MenuEntryBranchAssignment $entry */
		
		$entry->setMenuEntry($this->paramsManager->getParamByClass($request, MenuEntry::class));
		$entry->setBranch($this->paramsManager->getParamByClass($request, Branch::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var MenuEntryBranchAssignment $entry */
		
		$entry->setMenuEntry($template->getMenuEntry());
		$entry->setBranch($template->getBranch());
		
		return $entry;
	}

	protected function getEntityType() {
		return MenuEntryBranchAssignment::class;
	}
}