<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserNewsletterPageAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return NewsletterUserNewsletterPageAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterUserNewsletterPageAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setNewsletterUser($this->getParam($request, NewsletterUser::class));
		$entry->setNewsletterPage($this->getParam($request, NewsletterPage::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param NewsletterUserNewsletterPageAssignment $template
	 * 
	 * @return NewsletterUserNewsletterPageAssignment
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterUserNewsletterPageAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setNewsletterUser($template->getNewsletterUser());
		$entry->setNewsletterPage($template->getNewsletterPage());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterUserNewsletterPageAssignment::class;
	}
}