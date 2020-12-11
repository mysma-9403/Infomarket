<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\NewsletterUser;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserManager extends EntityManager {

	public function createFromRequest(Request $request) {
		/** @var NewsletterUser $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setName($request->get('name'));
		
		$entry->setInfomarket($request->get('infomarket', false));
		$entry->setInfoprodukt($request->get('infoprodukt', false));
		$entry->setSubscribed($request->get('subscribed', false));
		
		return $entry;
	}

	/**
	 *
	 * @param NewsletterUser $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var NewsletterUser $entry */
		
		$entry->setName($template->getName());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		$entry->setSubscribed($template->getSubscribed());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterUser::class;
	}
}