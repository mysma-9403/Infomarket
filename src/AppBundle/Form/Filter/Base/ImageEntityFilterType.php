<?php

namespace AppBundle\Form\Filter\Base;

use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Entity\Filter\Base\ImageEntityFilter;

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