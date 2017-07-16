<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\Advert;
use AppBundle\Factory\Common\Choices\Base\ChoicesFactory;

class AdvertLocationsFactory implements ChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				Advert::getLocationName(Advert::TOP_LOCATION)  => Advert::TOP_LOCATION,
				Advert::getLocationName(Advert::SIDE_LOCATION)  => Advert::SIDE_LOCATION,
				Advert::getLocationName(Advert::TEXT_LOCATION)  => Advert::TEXT_LOCATION,
				Advert::getLocationName(Advert::FEATURED_LOCATION)  => Advert::FEATURED_LOCATION
		];
	}
	
}