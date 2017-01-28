<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

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
		
		$entry->setSubname($request->get('subname'));
		
		$entry->setNewsletterBlockTemplate($this->getParam($request, NewsletterBlockTemplate::class));
		
		$entry->setNewsletterPage($this->getParam($request, NewsletterPage::class));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
		$entry->setXAdvertRatio($request->get('x_advert_ratio', 1));
		$entry->setYAdvertRatio($request->get('y_advert_ratio', 1));
		
		$entry->setXArticleRatio($request->get('x_article_ratio', 1));
		$entry->setYArticleRatio($request->get('y_article_ratio', 1));
		
		$entry->setXMagazineRatio($request->get('x_magazine_ratio', 1));
		$entry->setYMagazineRatio($request->get('y_magazine_ratio', 1));
		
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
		
		$entry->setSubname($template->getSubname());
		
		$entry->setNewsletterBlockTemplate($template->getNewsletterBlockTemplate());
		
		$entry->setNewsletterPage($template->getNewsletterPage());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		$entry->setXAdvertRatio($template->getXAdvertRatio());
		$entry->setYAdvertRatio($template->getYAdvertRatio());
		
		$entry->setXArticleRatio($template->getXArticleRatio());
		$entry->setYArticleRatio($template->getYArticleRatio());
		
		$entry->setXMagazineRatio($template->getXMagazineRatio());
		$entry->setYMagazineRatio($template->getYMagazineRatio());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterBlock::class;
	}
}