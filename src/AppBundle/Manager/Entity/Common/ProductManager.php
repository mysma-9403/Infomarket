<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Product;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Brand;

class ProductManager extends SimpleEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Product
	 */
	public function createFromRequest(Request $request) {
		/** @var Product $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setBrand($this->getParam($request, Brand::class));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Product $template
	 * 
	 * @return Product
	 */
	public function createFromTemplate($template) {
		/** @var Product $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setBrand($template->getBrand());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Product::class;
	}
}