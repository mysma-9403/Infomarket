<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use AppBundle\Entity\UserCategoryAssignment;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class UserCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var UserCategoryAssignment $entry */
		
		$entry->setUser($this->paramsManager->getParamByClass($request, User::class));
		$entry->setCategory($this->paramsManager->getParamByClass($request, Category::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var UserCategoryAssignment $entry */
		
		$entry->setUser($template->getUser());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}

	protected function getEntityType() {
		return UserCategoryAssignment::class;
	}
}