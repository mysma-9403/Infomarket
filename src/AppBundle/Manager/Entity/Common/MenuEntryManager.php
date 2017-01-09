<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\MenuEntry;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Page;
use AppBundle\Entity\Link;

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
		
		$entry->setMenu($request->get('menu'));
		$entry->setOrderNumber($request->get('order_number', 99));
		
		$entry->setPage($this->getParam($request, Page::class));
		$entry->setLink($this->getParam($request, Link::class));
		
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
		
		$entry->setMenu($template->getMenu());
		$entry->setOrderNumber($template->getOrderNumber());
		
		$entry->setPage($template->getPage());
		$entry->setLink($template->getLink());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return MenuEntry::class;
	}
}