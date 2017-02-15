<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Advert;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Infomarket\AdvertRepository;
use Symfony\Component\HttpFoundation\Request;

class AdvertParamsManager extends ParamsManager {
	
	protected $advertLocations;
	
	public function __construct($doctrine, array $advertLocations) {
		parent::__construct($doctrine);
		$this->advertLocations = $advertLocations;
	}
	
	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		if(count($this->advertLocations) > 0) {
			
			$em = $this->doctrine->getManager();
			
			$categories = $contextParams['categories'];
			
			/** @var AdvertRepository $advertRepository */
			$advertRepository = new AdvertRepository($em, $em->getClassMetadata(Advert::class));
			foreach($this->advertLocations as $advertLocation) {
				$adverts = $advertRepository->findAdvertItems($advertLocation, $categories);
				$viewParams[Advert::getLocationName($advertLocation)] = $adverts;
			
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
}