<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockTemplateManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return NewsletterBlockTemplate
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterBlockTemplate $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setContent($request->get('content'));
		$entry->setStyle($request->get('style'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param NewsletterBlockTemplate $template
	 * 
	 * @return NewsletterBlockTemplate
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterBlockTemplate $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setContent($template->getContent());
		$entry->setStyle($template->getStyle());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterBlockTemplate::class;
	}
}