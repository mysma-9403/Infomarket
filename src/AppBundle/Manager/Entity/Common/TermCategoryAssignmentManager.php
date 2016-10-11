<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\Term;
use AppBundle\Entity\TermCategoryAssignment;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class TermCategoryAssignmentManager extends EntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return TermCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var TermCategoryAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setTerm($this->getParam($request, Term::class));
		$entry->setCategory($this->getParam($request, Category::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param TermCategoryAssignment $template
	 * 
	 * @return TermCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var TermCategoryAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setTerm($template->getTerm());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return TermCategoryAssignment::class;
	}
}