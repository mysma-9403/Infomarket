<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Branch;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class BranchManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Branch
	 */
	public function createFromRequest(Request $request) {
		/** @var Branch $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setIcon($request->get('icon'));
		$entry->setColor($request->get('color'));
		$entry->setContent($request->get('content'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Branch $template
	 * 
	 * @return Branch
	 */
	public function createFromTemplate($template) {
		/** @var Branch $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setIcon($template->getIcon());
		$entry->setColor($template->getColor());
		$entry->setContent($template->getContent());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Branch::class;
	}
}