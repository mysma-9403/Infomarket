<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Branch;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryBranchAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 *
	 * @param Request $request        	
	 *
	 * @return MenuEntryBranchAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var MenuEntryBranchAssignment $entry */
		$entry = parent::createFromRequest ( $request );
		
		$entry->setMenuEntry ( $this->getParam ( $request, MenuEntry::class ) );
		$entry->setBranch ( $this->getParam ( $request, Branch::class ) );
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 *
	 * @param MenuEntryBranchAssignment $template        	
	 *
	 * @return MenuEntryBranchAssignment
	 */
	public function createFromTemplate($template) {
		/** @var MenuEntryBranchAssignment $entry */
		$entry = parent::createFromTemplate ( $template );
		
		$entry->setMenuEntry ( $template->getMenuEntry () );
		$entry->setBranch ( $template->getBranch () );
		
		return $entry;
	}
	protected function getEntityType() {
		return MenuEntryBranchAssignment::class;
	}
}