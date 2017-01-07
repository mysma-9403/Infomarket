<?php

namespace AppBundle\Manager\Filter\Decorator;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class InfoproduktFilterManager extends FilterManager {
	
	/** @var FilterManager */
	protected $fm;
	
	protected $filterByCategories;
	
	protected $filterBySubcategories;
	
	public function __construct(FilterManager $fm) {
		$this->fm = $fm;
		
		$this->filterByCategories = false;
		$this->filterBySubcategories = false;
	}
	
	public function setFilterByCategories($filterByCategories) {
		$this->filterByCategories = $filterByCategories;
	}
	
	public function setFilterBySubcategories($filterBySubcategories) {
		$this->filterBySubcategories = $filterBySubcategories;
	}
	
	public function createFromRequest(Request $request, array $params) {
		return $this->fm->createFromRequest($request, $params);
	}
	
	protected function create() {}
	
	public function adaptToView(BaseEntityFilter $filter, array $params) { 
		/** @var \AppBundle\Entity\Filter\Base\SimpleEntityFilter $filter */
		$filter = $this->fm->adaptToView($filter, $params);
		
		$filter->setInfoprodukt(BaseEntityFilter::TRUE_VALUES);
		
		if($this->filterByCategories) {
			$filter->setCategories($this->getCategories($params));
		}
		
		return $filter;
	}
	
	protected function getCategories($params) {
		$viewParams = $params['viewParams'];
		
		$categories = array();
		
		if(array_key_exists('category', $viewParams)) {
			$category = $viewParams['category'];
			$categories[] = $category;
			
			if($this->filterBySubcategories) {
				foreach ($category->getChildren() as $subcategory) {
					$categories[] = $subcategory;
				}
			}
		}
	
		return $categories;
	}
}