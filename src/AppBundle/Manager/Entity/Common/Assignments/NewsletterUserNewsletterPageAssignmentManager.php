<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\NewsletterUserNewsletterPageAssignment;
use AppBundle\Entity\Main\NewsletterPage;
use AppBundle\Entity\Main\NewsletterUser;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserNewsletterPageAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var NewsletterUserNewsletterPageAssignment $entry */
		
		$entry->setNewsletterUser($this->paramsManager->getParamByClass($request, NewsletterUser::class));
		$entry->setNewsletterPage($this->paramsManager->getParamByClass($request, NewsletterPage::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var NewsletterUserNewsletterPageAssignment $entry */
		
		$entry->setNewsletterUser($template->getNewsletterUser());
		$entry->setNewsletterPage($template->getNewsletterPage());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterUserNewsletterPageAssignment::class;
	}
}