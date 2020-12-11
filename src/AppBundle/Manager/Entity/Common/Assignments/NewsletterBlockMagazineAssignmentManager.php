<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment;
use AppBundle\Entity\Main\Magazine;
use AppBundle\Entity\Main\NewsletterBlock;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockMagazineAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var NewsletterBlockMagazineAssignment $entry */
		
		$entry->setNewsletterBlock($this->paramsManager->getParamByClass($request, NewsletterBlock::class));
		$entry->setMagazine($this->paramsManager->getParamByClass($request, Magazine::class));
		
		$entry->setAlternativeName($request->get('alternative_name'));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var NewsletterBlockMagazineAssignment $entry */
		
		$entry->setNewsletterBlock($template->getNewsletterBlock());
		$entry->setMagazine($template->getMagazine());
		
		$entry->setAlternativeName($template->getAlternativeName());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterBlockMagazineAssignment::class;
	}
}