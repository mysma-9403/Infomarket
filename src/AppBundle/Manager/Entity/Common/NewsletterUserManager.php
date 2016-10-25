<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return NewsletterUser
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterUser $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setSubscribed($request->get('subscribed'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param NewsletterUser $template
	 * 
	 * @return NewsletterUser
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterUser $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setSubscribed($template->getSubscribed());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterUser::class;
	}
}