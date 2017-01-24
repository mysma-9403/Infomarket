<?php

namespace AppBundle\Manager\Filter\Infomarket;

use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Manager\Filter\Common\ArticleFilterManager;

class IMArticleFilterManager extends ArticleFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var ArticleFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		if(count($filter->getCategories()) == 0) {
			$filter->setHiddenCategories($this->getCategories($params));
		} else {
			$filter->setCategories($this->getCategoriesFromParents($filter->getCategories()));
		}
		
		return $filter;
	}
	
	protected function getCategoriesFromParents($parentCategories) {		
		$categories = array();
		foreach ($parentCategories as $category) {
			$categories = array_merge($categories, $this->getSubcategories($category));
		}
	
		return $categories;
	}
	
	//TODO taken from InfomarketFilterManager - should be in some Utils??
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