<?php

namespace AppBundle\Manager\Params\Base;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\AdvertFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class AdvertParamsManager extends ParamsManager {
	
	protected $advertLocations;
	
	protected $infomarket;
	protected $infoprodukt;
	
	public function __construct($doctrine, array $advertLocations) {
		parent::__construct($doctrine);
		
		$this->advertLocations = $advertLocations;
		
		$this->infomarket = false;
		$this->infoprodukt = false;
	}
	
	public function getParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
		
		if(array_count_values($this->advertLocations) > 0) {
			$userRepository = $this->doctrine->getRepository(User::class);
			$categoryRepository = $this->doctrine->getRepository(Category::class);
			
			
			$advertFilter = new AdvertFilter($userRepository, $categoryRepository);
			if($this->infomarket) $advertFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
    		if($this->infoprodukt) $advertFilter->setInfoprodukt(BaseEntityFilter::TRUE_VALUES);
			$advertFilter->setActive(BaseEntityFilter::TRUE_VALUES);
		
			if(array_key_exists('branch', $viewParams)) {
				
				$branch = $viewParams['branch'];
				$categories = array();
				foreach ($branch->getBranchCategoryAssignments() as $branchCategoryAssignment) {
					$category = $branchCategoryAssignment->getCategory();
					if($this->infomarket && $category->getInfomarket()) {
						$categories[] = $category;
					}
					if($this->infoprodukt && $category->getInfoprodukt()) {
						$categories[] = $category;
					}
				}
				$advertFilter->setCategories($categories);
				
			} else if(array_key_exists('category', $viewParams)) {
				
				$category = $viewParams['category'];
				if ($category->getPreleaf()) {
					$advertFilter->setCategories([$category]);
				} else if ($category->getParent()) {
					$advertFilter->setCategories([$category->getParent()]);
				}
				
			}
			
			$em = $this->doctrine->getManager();
			
			foreach($this->advertLocations as $advertLocation) {
				$advertFilter->setLocations([$advertLocation]);
				
				$ads = $this->getParamList(Advert::class, $advertFilter);
				shuffle($ads);
				$ads = array_slice($ads, 0, 3);
				$viewParams[Advert::getLocationName($advertLocation)] = $ads;
					
				foreach($ads as $ad) {
					$ad->setShowCount($ad->getShowCount()+1);
					$em->persist($ad);
				}
				$em->flush();
			}
		}
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}