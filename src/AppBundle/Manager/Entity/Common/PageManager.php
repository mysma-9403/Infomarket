<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Page;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class PageManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Page
	 */
	public function createFromRequest(Request $request) {
		/** @var Page $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setSubname($request->get('subname'));
		
		$entry->setContent($request->get('content'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Page $template
	 * 
	 * @return Page
	 */
	public function createFromTemplate($template) {
		/** @var Page $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setSubname($template->getSubname());
		
		$entry->setContent($template->getContent());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Page::class;
	}
}