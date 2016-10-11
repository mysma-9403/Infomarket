<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Term;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class TermManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Term
	 */
	public function createFromRequest(Request $request) {
		/** @var Term $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setContent($request->get('content'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Term $template
	 * 
	 * @return Term
	 */
	public function createFromTemplate($template) {
		/** @var Term $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setContent($template->getContent());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Term::class;
	}
}