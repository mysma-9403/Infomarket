<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Brand;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Segment;

class BrandCategoryAssignmentManager extends EntityManager {
	
	/**
	 * Create new entry with request parameters.
	 *
	 * @param Request $request        	
	 *
	 * @return BrandCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var BrandCategoryAssignment $entry */
		$entry = parent::createFromRequest ( $request );
		
		$entry->setBrand ( $this->getParam ( $request, Brand::class ) );
		$entry->setCategory ( $this->getParam ( $request, Category::class ) );
		$entry->setSegment ( $this->getParam ( $request, Segment::class ) );
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 *
	 * @param BrandCategoryAssignment $template        	
	 *
	 * @return BrandCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var BrandCategoryAssignment $entry */
		$entry = parent::createFromTemplate ( $template );
		
		$entry->setBrand ( $template->getBrand () );
		$entry->setCategory ( $template->getCategory () );
		$entry->setSegment ( $template->getSegment () );
		
		return $entry;
	}
	protected function getEntityType() {
		return BrandCategoryAssignment::class;
	}
}