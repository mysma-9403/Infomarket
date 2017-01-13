<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Category;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Magazine;

class CategoryManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Category
	 */
	public function createFromRequest(Request $request) {
		/** @var Category $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setSubname($request->get('subname'));
		
		$entry->setFeatured($request->get('featured'));
		$entry->setPreleaf($request->get('preleaf'));
		
		$entry->setParent($this->getParamWithName($request, Category::class, 'parent'));
		
		$entry->setFeaturedImage($request->get('featured_image'));
		
		$entry->setIcon($request->get('icon'));
		
		$entry->setContent($request->get('content'));
		
		$entry->setOrderNumber($request->get('order_number'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Category $template
	 * 
	 * @return Category
	 */
	public function createFromTemplate($template) {
		/** @var Category $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setSubname($template->getSubname());
		
		$entry->setFeatured($template->getFeatured());
		$entry->setPreleaf($template->getPreleaf());
		
		$entry->setParent($template->getParent());
		
		$entry->setFeaturedImage($template->getFeaturedImage());
		
		$entry->setIcon($template->getIcon());
		
		$entry->setContent($template->getContent());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Category::class;
	}
}