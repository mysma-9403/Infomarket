<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Page;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class PageManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var Page $entry */
		
		$entry->setName($request->get('name'));
		$entry->setSubname($request->get('subname'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		
		$entry->setContent($request->get('content'));
		
		return $entry;
	}

	/**
	 *
	 * @param Page $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var Page $entry */
		
		$entry->setName($template->getName());
		$entry->setSubname($template->getSubname());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		
		$entry->setContent($template->getContent());
		
		return $entry;
	}

	protected function getEntityType() {
		return Page::class;
	}
}