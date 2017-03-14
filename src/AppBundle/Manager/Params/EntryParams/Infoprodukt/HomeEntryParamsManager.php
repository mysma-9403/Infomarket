<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Entity\Category;
use AppBundle\Entity\Magazine;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\Base\EntryParamsManager;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use AppBundle\Repository\Infoprodukt\MagazineRepository;
use Symfony\Component\HttpFoundation\Request;

class HomeEntryParamsManager extends EntryParamsManager {
	
	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		
		$em = $this->doctrine->getManager();
		
    	$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
    	$viewParams['categories'] = $categoryRepository->findHomeItems();
    	
    	$magazineRepository = new MagazineRepository($em, $em->getClassMetadata(Magazine::class));
    	$viewParams['magazines'] = $magazineRepository->findHomeItems();
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}