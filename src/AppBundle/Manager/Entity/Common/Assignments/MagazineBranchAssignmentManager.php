<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class MagazineBranchAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var MagazineBranchAssignment $entry */
		
		$entry->setMagazine($this->paramsManager->getParamByClass($request, Magazine::class));
		$entry->setBranch($this->paramsManager->getParamByClass($request, Branch::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var MagazineBranchAssignment $entry */
		
		$entry->setMagazine($template->getMagazine());
		$entry->setBranch($template->getBranch());
		
		return $entry;
	}

	protected function getEntityType() {
		return MagazineBranchAssignment::class;
	}
}