<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Term;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class TermManager extends EntityManager {

	public function createFromRequest(Request $request) {
		/** @var Term $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setName($request->get('name'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		
		$entry->setContent($request->get('content'));
		
		return $entry;
	}

	/**
	 *
	 * @param Term $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		/** @var Term $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setName($template->getName());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		
		$entry->setContent($template->getContent());
		
		return $entry;
	}

	protected function getEntityType() {
		return Term::class;
	}
}