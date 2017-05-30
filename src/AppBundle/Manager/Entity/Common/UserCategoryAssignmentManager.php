<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use AppBundle\Entity\UserCategoryAssignment;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class UserCategoryAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return UserCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var UserCategoryAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setUser($this->getParam($request, User::class));
		$entry->setCategory($this->getParam($request, Category::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param UserCategoryAssignment $template
	 * 
	 * @return UserCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var UserCategoryAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setUser($template->getUser());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return UserCategoryAssignment::class;
	}
}