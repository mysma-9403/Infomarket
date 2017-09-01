<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Entity\Base\AssignmentManager;

class ArticleCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var ArticleCategoryAssignment $entry */
		
		$entry->setArticle($this->paramsManager->getParamByClass($request, Article::class));
		$entry->setCategory($this->paramsManager->getParamByClass($request, Category::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var ArticleCategoryAssignment $entry */
		
		$entry->setArticle($template->getArticle());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}

	protected function getEntityType() {
		return ArticleCategoryAssignment::class;
	}
}