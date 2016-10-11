<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;

class NewsletterBlockManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return NewsletterBlock
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterBlock $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setNewsletterBlockTemplate($this->getParam($request, NewsletterBlockTemplate::class));
		
		$entry->setNewsletterPage($this->getParam($request, NewsletterPage::class));
		
		$entry->setAdvert($this->getParam($request, Advert::class));
		$entry->setArticle($this->getParam($request, Article::class));
		
		$entry->setOrderNumber($request->get('order_number'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param NewsletterBlock $template
	 * 
	 * @return NewsletterBlock
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterBlock $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setNewsletterBlockTemplate($template->getNewsletterBlockTemplate());
		
		$entry->setNewsletterPage($template->getNewsletterPage());
		
		$entry->setAdvert($template->getAdvert());
		$entry->setArticle($template->getArticle());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterBlock::class;
	}
}