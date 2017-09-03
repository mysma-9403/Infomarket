<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\NewsletterGroup;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterGroupManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var NewsletterGroup $entry */
		
		$entry->setName($request->get('name'));
		
		return $entry;
	}

	/**
	 *
	 * @param NewsletterGroup $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var NewsletterGroup $entry */
		
		$entry->setName($template->getName());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterGroup::class;
	}
}