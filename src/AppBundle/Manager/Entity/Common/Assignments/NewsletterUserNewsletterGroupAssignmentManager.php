<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserNewsletterGroupAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var NewsletterUserNewsletterGroupAssignment $entry */
		
		$entry->setNewsletterUser($this->paramsManager->getParamByClass($request, NewsletterUser::class));
		$entry->setNewsletterGroup($this->paramsManager->getParamByClass($request, NewsletterGroup::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var NewsletterUserNewsletterGroupAssignment $entry */
		
		$entry->setNewsletterUser($template->getNewsletterUser());
		$entry->setNewsletterGroup($template->getNewsletterGroup());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterUserNewsletterGroupAssignment::class;
	}
}