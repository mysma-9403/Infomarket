<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment;
use AppBundle\Entity\Main\Advert;
use AppBundle\Entity\Main\NewsletterBlock;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockAdvertAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var NewsletterBlockAdvertAssignment $entry */
		
		$entry->setNewsletterBlock($this->paramsManager->getParamByClass($request, NewsletterBlock::class));
		$entry->setAdvert($this->paramsManager->getParamByClass($request, Advert::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var NewsletterBlockAdvertAssignment $entry */
		
		$entry->setNewsletterBlock($template->getNewsletterBlock());
		$entry->setAdvert($template->getAdvert());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterBlockAdvertAssignment::class;
	}
}