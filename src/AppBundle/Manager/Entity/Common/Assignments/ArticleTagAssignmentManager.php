<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Tag;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleTagAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var ArticleTagAssignment $entry */
		
		$entry->setArticle($this->paramsManager->getParamByClass($request, Article::class));
		$entry->setTag($this->paramsManager->getParamByClass($request, Tag::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var ArticleTagAssignment $entry */
		
		$entry->setArticle($template->getArticle());
		$entry->setTag($template->getTag());
		
		return $entry;
	}

	protected function getEntityType() {
		return ArticleTagAssignment::class;
	}
}