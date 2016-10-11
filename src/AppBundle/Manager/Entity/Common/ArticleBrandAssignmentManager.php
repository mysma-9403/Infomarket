<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\Brand;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleBrandAssignmentManager extends EntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return ArticleBrandAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var ArticleBrandAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setArticle($this->getParam($request, Article::class));
		$entry->setBrand($this->getParam($request, Brand::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param ArticleBrandAssignment $template
	 * 
	 * @return ArticleBrandAssignment
	 */
	public function createFromTemplate($template) {
		/** @var ArticleBrandAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setArticle($template->getArticle());
		$entry->setBrand($template->getBrand());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return ArticleBrandAssignment::class;
	}
}