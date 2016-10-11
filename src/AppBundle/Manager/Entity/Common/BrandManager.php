<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Brand;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class BrandManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Brand
	 */
	public function createFromRequest(Request $request) {
		/** @var Brand $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setContent($request->get('content'));
		$entry->setWww($request->get('www'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Brand $template
	 * 
	 * @return Brand
	 */
	public function createFromTemplate($template) {
		/** @var Brand $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setContent($template->getContent());
		$entry->setWww($template->getWww());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Brand::class;
	}
}