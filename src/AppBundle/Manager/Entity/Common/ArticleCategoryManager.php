<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleCategoryManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return ArticleCategory
	 */
	public function createFromRequest(Request $request) {
		/** @var ArticleCategory $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setFeatured($request->get('featured'));
		$entry->setOrderNumber($request->get('order_number'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param ArticleCategory $template
	 * 
	 * @return ArticleCategory
	 */
	public function createFromTemplate($template) {
		/** @var ArticleCategory $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setFeatured($template->getFeatured());
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return ArticleCategory::class;
	}
}