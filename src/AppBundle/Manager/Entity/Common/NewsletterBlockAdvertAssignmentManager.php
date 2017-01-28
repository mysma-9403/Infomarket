<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockAdvertAssignment;
use AppBundle\Entity\Advert;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockAdvertAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return NewsletterBlockAdvertAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterBlockAdvertAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setNewsletterBlock($this->getParam($request, NewsletterBlock::class));
		$entry->setAdvert($this->getParam($request, Advert::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param NewsletterBlockAdvertAssignment $template
	 * 
	 * @return NewsletterBlockAdvertAssignment
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterBlockAdvertAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setNewsletterBlock($template->getNewsletterBlock());
		$entry->setAdvert($template->getAdvert());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterBlockAdvertAssignment::class;
	}
}