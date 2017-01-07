<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\BrandFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;

class BrandFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return BrandFilter::class;
	}
}