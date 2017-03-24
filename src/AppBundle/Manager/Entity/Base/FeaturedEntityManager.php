<?php

namespace AppBundle\Manager\Entity\Base;

use AppBundle\Entity\Base\SimpleEntity;
use Symfony\Component\HttpFoundation\Request;

abstract class FeaturedEntityManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return SimpleEntity
	 */
	public function createFromRequest(Request $request) {
		/** @var SimpleEntity $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setFeatured($request->get('featured'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param SimpleEntity $template
	 * 
	 * @return SimpleEntity
	 */
	public function createFromTemplate($template) {
		/** @var SimpleEntity $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setFeatured($template->getFeatured());
		
		return $entry;
	}
}