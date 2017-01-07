<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Advert;
use AppBundle\Entity\AdvertCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class AdvertCategoryAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return AdvertCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var AdvertCategoryAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setAdvert($this->getParam($request, Advert::class));
		$entry->setCategory($this->getParam($request, Category::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param AdvertCategoryAssignment $template
	 * 
	 * @return AdvertCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var AdvertCategoryAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setAdvert($template->getAdvert());
		$entry->setCategory($template->getCategory());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return AdvertCategoryAssignment::class;
	}
}