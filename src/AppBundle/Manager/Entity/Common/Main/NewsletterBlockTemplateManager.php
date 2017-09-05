<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\NewsletterBlockTemplate;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockTemplateManager extends EntityManager {

	public function createFromRequest(Request $request) {
		/** @var NewsletterBlockTemplate $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setName($request->get('name'));
		
		$entry->setStyle($request->get('style'));
		$entry->setContent($request->get('content'));
		$entry->setAdvertContent($request->get('advert_content'));
		$entry->setArticleContent($request->get('article_content'));
		$entry->setMagazineContent($request->get('magazine_content'));
		
		return $entry;
	}

	/**
	 *
	 * @param NewsletterBlockTemplate $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterBlockTemplate $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setName($template->getName());
		
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