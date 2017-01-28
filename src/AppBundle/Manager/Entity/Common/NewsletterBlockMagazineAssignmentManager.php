<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockMagazineAssignment;
use AppBundle\Entity\Magazine;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockMagazineAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return NewsletterBlockMagazineAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterBlockMagazineAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setNewsletterBlock($this->getParam($request, NewsletterBlock::class));
		$entry->setMagazine($this->getParam($request, Magazine::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param NewsletterBlockMagazineAssignment $template
	 * 
	 * @return NewsletterBlockMagazineAssignment
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterBlockMagazineAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setNewsletterBlock($template->getNewsletterBlock());
		$entry->setMagazine($template->getMagazine());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterBlockMagazineAssignment::class;
	}
}