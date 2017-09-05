<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\Brand;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class BrandManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var Brand $entry */
		
		$entry->setName($request->get('name'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		
		$entry->setContent($request->get('content'));
		
		$entry->setWww($request->get('www'));
		
		return $entry;
	}

	/**
	 *
	 * @param Brand $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var Brand $entry */
		
		$entry->setName($template->getName());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		
		$entry->setContent($template->getContent());
		$entry->setWww($template->getWww());
		
		return $entry;
	}

	protected function getEntityType() {
		return Brand::class;
	}
}