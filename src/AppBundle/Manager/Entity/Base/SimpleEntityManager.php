<?php

namespace AppBundle\Manager\Entity\Base;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Base\SimpleEntity;

abstract class SimpleEntityManager extends EntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return SimpleEntity
	 */
	public function createFromRequest(Request $request) {
		/** @var SimpleEntity $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setName($request->get('name'));
		
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
		
		$entry->setName($template->getName());
		
		return $entry;
	}
}