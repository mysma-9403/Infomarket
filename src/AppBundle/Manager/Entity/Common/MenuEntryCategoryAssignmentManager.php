<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryCategoryAssignment;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryCategoryAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 *
	 * @param Request $request        	
	 *
	 * @return MenuEntryCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var MenuEntryCategoryAssignment $entry */
		$entry = parent::createFromRequest ( $request );
		
		$entry->setMenuEntry ( $this->getParam ( $request, MenuEntry::class ) );
		$entry->setCategory ( $this->getParam ( $request, Category::class ) );
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 *
	 * @param MenuEntryCategoryAssignment $template        	
	 *
	 * @return MenuEntryCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var MenuEntryCategoryAssignment $entry */
		$entry = parent::createFromTemplate ( $template );
		
		$entry->setMenuEntry ( $template->getMenuEntry () );
		$entry->setCategory ( $template->getCategory () );
		
		return $entry;
	}
	protected function getEntityType() {
		return MenuEntryCategoryAssignment::class;
	}
}