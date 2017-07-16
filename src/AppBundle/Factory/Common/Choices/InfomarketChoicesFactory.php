<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Factory\Common\Choices\Base\ChoicesFactory;
use AppBundle\Filter\Base\Filter;

class InfomarketChoicesFactory implements ChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				'label.all'				=> Filter::ALL_VALUES,
				'label.infomarket' 		=> Filter::TRUE_VALUES,
				'label.notInfomarket' 	=> Filter::FALSE_VALUES
		];
	}
	
}