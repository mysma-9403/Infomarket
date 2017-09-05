<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\MenuMenuEntryAssignment;
use AppBundle\Entity\Main\Menu;
use AppBundle\Entity\Main\MenuEntry;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class MenuMenuEntryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var MenuMenuEntryAssignment $entry */
		
		$entry->setMenu($this->paramsManager->getParamByClass($request, Menu::class));
		$entry->setMenuEntry($this->paramsManager->getParamByClass($request, MenuEntry::class));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var MenuMenuEntryAssignment $entry */
		
		$entry->setMenu($template->getMenu());
		$entry->setMenuEntry($template->getMenuEntry());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}

	protected function getEntityType() {
		return MenuMenuEntryAssignment::class;
	}
}