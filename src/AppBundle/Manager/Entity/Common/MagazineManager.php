<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Magazine;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class MagazineManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Magazine
	 */
	public function createFromRequest(Request $request) {
		/** @var Magazine $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setFeatured($request->get('featured'));
		
		$entry->setContent($request->get('content'));
		
		$entry->setOrderNumber($request->get('order_number'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Magazine $template
	 * 
	 * @return Magazine
	 */
	public function createFromTemplate($template) {
		/** @var Magazine $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setFeatured($template->getFeatured());
		
		$entry->setContent($template->getContent());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Magazine::class;
	}
}