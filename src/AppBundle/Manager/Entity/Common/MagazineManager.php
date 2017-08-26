<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Magazine;
use AppBundle\Manager\Entity\Base\FeaturedEntityManager;
use Symfony\Component\HttpFoundation\Request;

class MagazineManager extends FeaturedEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Magazine
	 */
	public function createFromRequest(Request $request) {
		/** @var Magazine $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setContent($request->get('content'));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
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
		
		$entry->setContent($template->getContent());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Magazine::class;
	}
}