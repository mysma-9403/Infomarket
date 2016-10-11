<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Branch;
use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class BranchCategoryAssignmentManager extends EntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return BranchCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var BranchCategoryAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setBranch($this->getParam($request, Branch::class));
		$entry->setCategory($this->getParam($request, Category::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param BranchCategoryAssignment $template
	 * 
	 * @return BranchCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var BranchCategoryAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setBranch($template->getBranch());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return BranchCategoryAssignment::class;
	}
}