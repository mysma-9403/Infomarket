<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Entity\Segment;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class ProductCategoryAssignmentManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return ProductCategoryAssignment
	 */
	public function createFromRequest(Request $request) {
		/** @var ProductCategoryAssignment $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setProduct($this->getParam($request, Product::class));
		$entry->setCategory($this->getParam($request, Category::class));
		$entry->setSegment($this->getParam($request, Segment::class));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		$entry->setFeatured($request->get('featured', false));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param ProductCategoryAssignment $template
	 * 
	 * @return ProductCategoryAssignment
	 */
	public function createFromTemplate($template) {
		/** @var ProductCategoryAssignment $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setProduct($template->getProduct());
		$entry->setCategory($template->getCategory());
		$entry->setSegment($template->getSegment());
		
		$entry->setOrderNumber($template->getOrderNumber());
		$entry->setFeatured($template->getFeatured());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return ProductCategoryAssignment::class;
	}
}