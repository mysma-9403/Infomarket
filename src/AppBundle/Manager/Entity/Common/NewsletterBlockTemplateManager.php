<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockTemplateManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return NewsletterBlockTemplate
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterBlockTemplate $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setStyle($request->get('style'));
		$entry->setContent($request->get('content'));
		$entry->setAdvertContent($request->get('advert_content'));
		$entry->setArticleContent($request->get('article_content'));
		$entry->setMagazineContent($request->get('magazine_content'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param NewsletterBlockTemplate $template
	 * 
	 * @return NewsletterBlockTemplate
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterBlockTemplate $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setStyle($template->getStyle());
		$entry->setContent($template->getContent());
		$entry->setAdvertContent($template->getAdvertContent());
		$entry->setArticleContent($template->getArticleContent());
		$entry->setMagazineContent($template->getMagazineContent());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterBlockTemplate::class;
	}
}