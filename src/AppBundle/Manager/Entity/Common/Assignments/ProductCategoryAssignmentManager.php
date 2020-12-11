<?php

namespace AppBundle\Manager\Entity\Common\Assignments;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Main\Segment;
use AppBundle\Manager\Entity\Base\AssignmentManager;
use Symfony\Component\HttpFoundation\Request;

class ProductCategoryAssignmentManager extends AssignmentManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var ProductCategoryAssignment $entry */
		
		$entry->setProduct($this->paramsManager->getParamByClass($request, Product::class));
		$entry->setCategory($this->paramsManager->getParamByClass($request, Category::class));
		$entry->setSegment($this->paramsManager->getParamByClass($request, Segment::class));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		$entry->setFeatured($request->get('featured', false));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var ProductCategoryAssignment $entry */
		
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