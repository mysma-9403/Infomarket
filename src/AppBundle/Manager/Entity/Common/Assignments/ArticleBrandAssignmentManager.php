<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\Brand;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleBrandAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var ArticleBrandAssignment $entry */
		
		$entry->setArticle($this->paramsManager->getParamByClass($request, Article::class));
		$entry->setBrand($this->paramsManager->getParamByClass($request, Brand::class));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var ArticleBrandAssignment $entry */
		
		$entry->setArticle($template->getArticle());
		$entry->setBrand($template->getBrand());
		
		return $entry;
	}

	protected function getEntityType() {
		return ArticleBrandAssignment::class;
	}
}