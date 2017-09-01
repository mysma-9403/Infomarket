<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Magazine;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class MagazineManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var Magazine $entry */
		
		$entry->setName($request->get('name'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		$entry->setFeatured($request->get('featured'));
		
		$entry->setContent($request->get('content'));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
		return $entry;
	}

	/**
	 *
	 * @param Magazine $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var Magazine $entry */
		
		$entry->setName($template->getName());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		$entry->setFeatured($template->getFeatured());
		
		$entry->setContent($template->getContent());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}

	protected function getEntityType() {
		return Magazine::class;
	}
}