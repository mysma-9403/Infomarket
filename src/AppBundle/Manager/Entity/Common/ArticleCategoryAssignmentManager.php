<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleCategoryAssignmentManager extends EntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return ArticleCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var ArticleCategoryAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setArticle($this->getParam($request, Article::class));
		$entry->setCategory($this->getParam($request, Category::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param ArticleCategoryAssignment $template
	 * 
	 * @return ArticleCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var ArticleCategoryAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setArticle($template->getArticle());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return ArticleCategoryAssignment::class;
	}
}