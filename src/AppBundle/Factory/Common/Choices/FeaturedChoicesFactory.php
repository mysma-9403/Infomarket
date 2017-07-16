<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Factory\Common\Choices\Base\ChoicesFactory;
use AppBundle\Filter\Base\Filter;

class FeaturedChoicesFactory implements ChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				'label.all'			=> Filter::ALL_VALUES,
				'label.featured' 	=> Filter::TRUE_VALUES,
				'label.notFeatured' => Filter::FALSE_VALUES
		];
	}
	
}