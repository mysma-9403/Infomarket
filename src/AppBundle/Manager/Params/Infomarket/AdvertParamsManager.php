<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Main\Advert;
use AppBundle\Repository\Infomarket\AdvertRepository;
use Symfony\Component\HttpFoundation\Request;

class AdvertParamsManager {

	/**
	 *
	 * @var array
	 */
	protected $advertLocations;

	/**
	 *
	 * @var boolean
	 */
	protected $checkInRoots;

	/**
	 *
	 * @var AdvertRepository
	 */
	protected $advertRepository;

	public function __construct(AdvertRepository $advertRepository, array $advertLocations) {
		$this->advertRepository = $advertRepository;
		$this->advertLocations = $advertLocations;
		$this->checkInRoots = true;
	}

	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		if (count($this->advertLocations) > 0) {
			$categories = $this->getContextCategories($request, $contextParams, $viewParams);
			
			foreach ($this->advertLocations as $advertLocation) {
				$adverts = $this->advertRepository->findAdvertItems($advertLocation, $categories, 
						$this->checkInRoots);
				$viewParams[Advert::getLocationParam($advertLocation)] = $adverts;
				
				if (count($adverts) > 0) {
					$advertsIds = $this->advertRepository->getIds($adverts);
					$this->advertRepository->updateAdvertsShowCounts($advertsIds);
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