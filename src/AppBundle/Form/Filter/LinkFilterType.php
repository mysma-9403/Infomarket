<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\Filter\LinkFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;

class LinkFilterType extends SimpleEntityFilterType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return LinkFilter::class;
	}
}