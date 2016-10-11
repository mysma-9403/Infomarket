<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleArticleCategoryAssignmentManager extends EntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return ArticlearticleCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var ArticleArticleCategoryAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setArticle($this->getParam($request, Article::class));
		$entry->setArticleCategory($this->getParam($request, ArticleCategory::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param ArticlearticleCategoryAssignment $template
	 * 
	 * @return ArticlearticleCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var ArticleArticleCategoryAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setArticle($template->getArticle());
		$entry->setArticleCategory($template->getArticleCategory());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return ArticleArticleCategoryAssignment::class;
	}
}