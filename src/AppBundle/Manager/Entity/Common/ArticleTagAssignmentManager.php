<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Tag;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleTagAssignmentManager extends EntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return ArticleTagAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var ArticleTagAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setArticle($this->getParam($request, Article::class));
		$entry->setTag($this->getParam($request, Tag::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param ArticleTagAssignment $template
	 * 
	 * @return ArticleTagAssignment
	 */
	public function createFromTemplate($template) {
		/** @var ArticleTagAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setArticle($template->getArticle());
		$entry->setTag($template->getTag());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return ArticleTagAssignment::class;
	}
}