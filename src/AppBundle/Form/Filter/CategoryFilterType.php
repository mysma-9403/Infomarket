<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Form\Filter\Base\ImageEntityFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;

class CategoryFilterType extends ImageEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return CategoryFilter::class;
	}
}