<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Link;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\Page;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return MenuEntry
	 */
	public function createFromRequest(Request $request) {
		/** @var MenuEntry $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setParent($this->getParamWithName($request, MenuEntry::class, 'parent'));
		
		$entry->setPage($this->getParam($request, Page::class));
		$entry->setLink($this->getParam($request, Link::class));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param MenuEntry $template
	 * 
	 * @return MenuEntry
	 */
	public function createFromTemplate($template) {
		/** @var MenuEntry $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setParent($template->getParent());
		
		$entry->setPage($template->getPage());
		$entry->setLink($template->getLink());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return MenuEntry::class;
	}
}