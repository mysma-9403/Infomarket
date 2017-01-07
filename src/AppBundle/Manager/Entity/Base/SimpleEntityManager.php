<?php

namespace AppBundle\Manager\Entity\Base;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Base\SimpleEntity;

abstract class SimpleEntityManager extends BaseEntityManager {
	
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
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		
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
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		
		return $entry;
	}
}