<?php

namespace AppBundle\Form\Filter\Base;

use AppBundle\Entity\Filter\ImageEntityFilter;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;

class ImageEntityFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return ImageEntityFilter::class;
	}
}