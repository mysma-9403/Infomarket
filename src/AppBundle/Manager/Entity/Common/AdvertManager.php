<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Advert;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class AdvertManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Advert
	 */
	public function createFromRequest(Request $request) {
		/** @var Advert $entry */
		$entry = parent::createFromRequest($request);
		
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
	 * Create new entry with template parameters.
	 * @param Advert $template
	 * 
	 * @return Advert
	 */
	public function createFromTemplate($template) {
		/** @var Advert $entry */
		$entry = parent::createFromTemplate($template);
		
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