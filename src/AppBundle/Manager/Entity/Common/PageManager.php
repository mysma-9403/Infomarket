<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Page;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class PageManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Page
	 */
	public function createFromRequest(Request $request) {
		/** @var Page $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setSubname($request->get('subname'));
		
		$entry->setFeatured($request->get('featured'));
		
		$entry->setContent($request->get('content'));
		
		$entry->setOrderNumber($request->get('order_number'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Page $template
	 * 
	 * @return Page
	 */
	public function createFromTemplate($template) {
		/** @var Page $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setSubname($template->getSubname());
		
		$entry->setFeatured($template->getFeatured());
		
		$entry->setContent($template->getContent());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Page::class;
	}
}