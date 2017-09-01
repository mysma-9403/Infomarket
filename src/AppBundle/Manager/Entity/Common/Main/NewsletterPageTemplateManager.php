<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterPageTemplateManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var NewsletterPageTemplate $entry */
		
		$entry->setName($request->get('name'));
		
		$entry->setContent($request->get('content'));
		
		return $entry;
	}

	/**
	 *
	 * @param NewsletterPageTemplate $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var NewsletterPageTemplate $entry */
		
		$entry->setName($template->getName());
		
		$entry->setContent($template->getContent());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterPageTemplate::class;
	}
}