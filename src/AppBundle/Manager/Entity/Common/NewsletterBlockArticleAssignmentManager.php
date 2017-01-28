<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockArticleAssignment;
use AppBundle\Entity\Article;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockArticleAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return NewsletterBlockArticleAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var NewsletterBlockArticleAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setNewsletterBlock($this->getParam($request, NewsletterBlock::class));
		$entry->setArticle($this->getParam($request, Article::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param NewsletterBlockArticleAssignment $template
	 * 
	 * @return NewsletterBlockArticleAssignment
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterBlockArticleAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setNewsletterBlock($template->getNewsletterBlock());
		$entry->setArticle($template->getArticle());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return NewsletterBlockArticleAssignment::class;
	}
}