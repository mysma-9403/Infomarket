<?php

namespace AppBundle\Manager\Filter\Decorator;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Manager\Filter\Base\FilterManager;

class InfomarketFilterManager extends FilterManager {
	
	/** @var FilterManager */
	protected $fm;
	
	protected $filterByBranches;
	
	protected $filterByCategories;
	
	public function __construct(FilterManager $fm) {
		$this->fm = $fm;
		
		$this->filterByBranches = false;
		$this->filterByCategories = false;
	}
	
	public function setFilterByBranches($filterByBranches) {
		$this->filterByBranches = $filterByBranches;
	}
	
	public function setFilterByCategories($filterByCategories) {
		$this->filterByCategories = $filterByCategories;
	}
	
	public function createFromRequest(Request $request, array $params) {
		return $this->fm->createFromRequest($request, $params);
	}
	
	protected function create() {}
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var \AppBundle\Entity\Filter\Base\SimpleEntityFilter $filter */
		$filter = $this->fm->adaptToView($filter, $params);
		
		$filter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
		
		if($this->filterByBranches) {
			$filter->setBranches($this->getBranches($params));
		}
		
		if($this->filterByCategories) {
			$filter->setCategories($this->getCategories($params));
		}
		
		return $filter;
	}
	
	protected function getBranches($params) {
		$viewParams = $params['viewParams'];
		$branch = $viewParams['branch'];
		
		return [$branch];
	}
	
	protected function getCategories($params) {
		$viewParams = $params['viewParams'];
		$branch = $viewParams['branch'];
			
		$categories = array();
		foreach ($branch->getBranchCategoryAssignments() as $branchCategoryAssignment) {
			$category = $branchCategoryAssignment->getCategory();
			
			$categories = array_merge($categories, $this->getSubcategories($category));
		}
	
		return $categories;
	}
	
	protected function getSubcategories($category) {
		$categories = [$category];
	
		foreach($category->getChildren() as $subcategory) {
			$categories = array_merge($categories, $this->getSubcategories($subcategory));
		}
	
		return $categories;
	}
}