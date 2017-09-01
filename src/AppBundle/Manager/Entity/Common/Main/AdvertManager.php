<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Advert;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class AdvertManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var Advert $entry */
		
		$entry->setName($request->get('name'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		
		$entry->setLink($request->get('link'));
		
		$entry->setLocation($request->get('location'));
		
		$entry->setDateFrom($request->get('date_from'));
		$entry->setDateTo($request->get('date_to'));
		
		$entry->setClickCount($request->get('click_count'));
		$entry->setClickLimit($request->get('click_limit'));
		
		$entry->setShowCount($request->get('show_count'));
		$entry->setShowLimit($request->get('show_limit'));
		
		return $entry;
	}

	/**
	 *
	 * @param Advert $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var Advert $entry */
		
		$entry->setName($template->getName());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		
		$entry->setLink($template->getLink());
		
		$entry->setLocation($template->getLocation());
		
		$entry->setDateFrom($template->getDateFrom());
		$entry->setDateTo($template->getDateTo());
		
		$entry->setClickCount($template->getClickCount());
		$entry->setClickLimit($template->getClickLimit());
		
		$entry->setShowCount($template->getShowCount());
		$entry->setShowLimit($template->getShowLimit());
		
		return $entry;
	}

	protected function getEntityType() {
		return Advert::class;
	}
}