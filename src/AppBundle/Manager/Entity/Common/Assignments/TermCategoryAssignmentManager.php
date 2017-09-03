<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\TermCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Term;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class TermCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var TermCategoryAssignment $entry */
		
		$entry->setTerm($this->paramsManager->getParamByClass($request, Term::class));
		$entry->setCategory($this->paramsManager->getParamByClass($request, Category::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var TermCategoryAssignment $entry */
		
		$entry->setTerm($template->getTerm());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}

	protected function getEntityType() {
		return TermCategoryAssignment::class;
	}
}