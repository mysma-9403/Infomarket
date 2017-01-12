<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class MenuMenuEntryAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return MenuMenuEntryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var MenuMenuEntryAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setMenu($this->getParam($request, Menu::class));
		$entry->setMenuEntry($this->getParam($request, MenuEntry::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param MenuMenuEntryAssignment $template
	 * 
	 * @return MenuMenuEntryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var MenuMenuEntryAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setMenu($template->getMenu());
		$entry->setMenuEntry($template->getMenuEntry());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return MenuMenuEntryAssignment::class;
	}
}