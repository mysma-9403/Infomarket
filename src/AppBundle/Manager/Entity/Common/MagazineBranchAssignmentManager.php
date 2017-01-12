<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class MagazineBranchAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 *
	 * @param Request $request        	
	 *
	 * @return MagazineBranchAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var MagazineBranchAssignment $entry */
		$entry = parent::createFromRequest ( $request );
		
		$entry->setMagazine ( $this->getParam ( $request, Magazine::class ) );
		$entry->setBranch ( $this->getParam ( $request, Branch::class ) );
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 *
	 * @param MagazineBranchAssignment $template        	
	 *
	 * @return MagazineBranchAssignment
	 */
	public function createFromTemplate($template) {
		/** @var MagazineBranchAssignment $entry */
		$entry = parent::createFromTemplate ( $template );
		
		$entry->setMagazine ( $template->getMagazine () );
		$entry->setBranch ( $template->getBranch () );
		
		return $entry;
	}
	protected function getEntityType() {
		return MagazineBranchAssignment::class;
	}
}