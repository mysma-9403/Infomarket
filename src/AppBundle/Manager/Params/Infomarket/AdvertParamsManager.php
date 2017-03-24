<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Advert;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Infomarket\AdvertRepository;
use Symfony\Component\HttpFoundation\Request;

class AdvertParamsManager extends ParamsManager {
	
	protected $advertLocations;
	
	protected $checkInRoots;
	
	public function __construct($doctrine, array $advertLocations) {
		parent::__construct($doctrine);
		$this->advertLocations = $advertLocations;
		$this->checkInRoots = true;
	}
	
	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		if(count($this->advertLocations) > 0) {
			
			$em = $this->doctrine->getManager();
			
			$categories = $this->getContextCategories($request, $contextParams, $viewParams);
			
			/** @var AdvertRepository $advertRepository */
			$advertRepository = new AdvertRepository($em, $em->getClassMetadata(Advert::class));
			foreach($this->advertLocations as $advertLocation) {
				$adverts = $advertRepository->findAdvertItems($advertLocation, $categories, $this->checkInRoots);
				$viewParams[Advert::getLocationParam($advertLocation)] = $adverts;
			
				if(count($adverts) > 0) {
					$advertsIds = $advertRepository->getIds($adverts);
					$advertRepository->updateAdvertsShowCounts($advertsIds);
				}
			}
		}
		
		$params['contextParams'] = $contextParams;
		$params['viewParams'] = $viewParams;
		return $params;
	}
	
	protected function getContextCategories(Request $request, $contextParams, $viewParams) {
		return $contextParams['categories'];
	}
}