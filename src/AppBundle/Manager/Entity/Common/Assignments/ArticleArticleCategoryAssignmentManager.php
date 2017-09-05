<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment;
use AppBundle\Entity\Main\Article;
use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleArticleCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var ArticleArticleCategoryAssignment $entry */
		
		$entry->setArticle($this->paramsManager->getParamByClass($request, Article::class));
		$entry->setArticleCategory($this->paramsManager->getParamByClass($request, ArticleCategory::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var ArticleArticleCategoryAssignment $entry */
		
		$entry->setArticle($template->getArticle());
		$entry->setArticleCategory($template->getArticleCategory());
		
		return $entry;
	}

	protected function getEntityType() {
		return ArticleArticleCategoryAssignment::class;
	}
}