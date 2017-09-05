<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\BranchCategoryAssignment;
use AppBundle\Entity\Main\Branch;
use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class BranchCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var BranchCategoryAssignment $entry */
		
		$entry->setBranch($this->paramsManager->getParamByClass($request, Branch::class));
		$entry->setCategory($this->paramsManager->getParamByClass($request, Category::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var BranchCategoryAssignment $entry */
		
		$entry->setBranch($template->getBranch());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}

	protected function getEntityType() {
		return BranchCategoryAssignment::class;
	}
}