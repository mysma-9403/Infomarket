<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\MenuFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;

class MenuFilterType extends SimpleEntityFilterType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return MenuFilter::class;
	}
}