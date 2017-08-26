<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterPageManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return NewsletterPage
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterPage $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setName($request->get('name'));
		$entry->setSubname($request->get('subname'));
		
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
		
		$entry->setName($template->getName());
		$entry->setSubname($template->getSubname());
		
		$entry->setNewsletterPageTemplate($template->getNewsletterPageTemplate());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterPage::class;
	}
}