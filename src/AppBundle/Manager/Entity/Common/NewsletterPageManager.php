<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterPageManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return NewsletterPage
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterPage $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setNewsletterPageTemplate($this->getParam($request, NewsletterPageTemplate::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param NewsletterPage $template
	 * 
	 * @return NewsletterPage
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterPage $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setNewsletterPageTemplate($template->getNewsletterPageTemplate());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterPage::class;
	}
}