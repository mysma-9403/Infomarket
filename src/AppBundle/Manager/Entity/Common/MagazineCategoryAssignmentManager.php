<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineCategoryAssignment;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class MagazineCategoryAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 *
	 * @param Request $request        	
	 *
	 * @return MagazineCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var MagazineCategoryAssignment $entry */
		$entry = parent::createFromRequest ( $request );
		
		$entry->setMagazine ( $this->getParam ( $request, Magazine::class ) );
		$entry->setCategory ( $this->getParam ( $request, Category::class ) );
		
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 *
	 * @param MagazineCategoryAssignment $template        	
	 *
	 * @return MagazineCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var MagazineCategoryAssignment $entry */
		$entry = parent::createFromTemplate ( $template );
		
		$entry->setMagazine ( $template->getMagazine () );
		$entry->setCategory ( $template->getCategory () );
		
		return $entry;
	}
	protected function getEntityType() {
		return MagazineCategoryAssignment::class;
	}
}