<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Entity\NewsletterGroup;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserNewsletterGroupAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return NewsletterUserNewsletterGroupAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterUserNewsletterGroupAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setNewsletterUser($this->getParam($request, NewsletterUser::class));
		$entry->setNewsletterGroup($this->getParam($request, NewsletterGroup::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param NewsletterUserNewsletterGroupAssignment $template
	 * 
	 * @return NewsletterUserNewsletterGroupAssignment
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterUserNewsletterGroupAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setNewsletterUser($template->getNewsletterUser());
		$entry->setNewsletterGroup($template->getNewsletterGroup());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterUserNewsletterGroupAssignment::class;
	}
}