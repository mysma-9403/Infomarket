<?php

namespace AppBundle\Manager\Params\Infoprodukt;

use AppBundle\Entity\Advert;
use AppBundle\Repository\Infoprodukt\AdvertRepository;
use Symfony\Component\HttpFoundation\Request;

class AdvertParamsManager {

	/**
	 *
	 * @var array
	 */
	protected $advertLocations;

	/**
	 *
	 * @var AdvertRepository
	 */
	protected $advertRepository;

	public function __construct(AdvertRepository $advertRepository, array $advertLocations) {
		$this->advertRepository = $advertRepository;
		$this->advertLocations = $advertLocations;
	}

	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		if (count($this->advertLocations) > 0) {
			$categories = $contextParams['categories'];
			
			foreach ($this->advertLocations as $advertLocation) {
				$adverts = $this->advertRepository->findAdvertItems($advertLocation, $categories);
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
}