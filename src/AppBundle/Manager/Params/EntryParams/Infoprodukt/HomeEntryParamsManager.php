<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\Branch;

class HomeEntryParamsManager extends EntryParamsManager {
	
	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		
		$userRepository = $this->doctrine->getRepository(User::class);
		$branchRepository = $this->doctrine->getRepository(Branch::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
		
		
    	$categoryFilter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
    	$categoryFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$categoryFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$categoryFilter->setPreleaf(BaseEntityFilter::TRUE_VALUES);
    	$categoryFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
    	$categoryFilter->setLimit(12);
    	 
    	$categories = $this->getParamList(Category::class, $categoryFilter);
    	$viewParams['categories'] = $categories;
    	
    	
    	$magazineFilter = new MagazineFilter($userRepository, $categoryRepository);
    	$magazineFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$magazineFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$magazineFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
    	$magazineFilter->setLimit(6);
    	
    	$magazines = $this->getParamList(Magazine::class, $magazineFilter);
    	$viewParams['magazines'] = $magazines;
    	
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}