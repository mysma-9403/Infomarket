<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment;
use AppBundle\Entity\Main\Article;
use AppBundle\Entity\Main\NewsletterBlock;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockArticleAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var NewsletterBlockArticleAssignment $entry */
		
		$entry->setNewsletterBlock($this->paramsManager->getParamByClass($request, NewsletterBlock::class));
		$entry->setArticle($this->paramsManager->getParamByClass($request, Article::class));
		
		$entry->setAlternativeName($request->get('alternative_name'));
		$entry->setAlternativeSubname($request->get('alternative_subname'));
		$entry->setAlternativeBrands($request->get('alternative_brands'));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var NewsletterBlockArticleAssignment $entry */
		
		$entry->setNewsletterBlock($template->getNewsletterBlock());
		$entry->setArticle($template->getArticle());
		
		$entry->setAlternativeName($template->getAlternativeName());
		$entry->setAlternativeSubname($template->getAlternativeSubname());
		$entry->setAlternativeBrands($template->getAlternativeBrands());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterBlockArticleAssignment::class;
	}
}