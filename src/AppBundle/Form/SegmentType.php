<?php

namespace AppBundle\Form;

use AppBundle\Entity\Segment;
use AppBundle\Form\Base\ImageEntityType;

class SegmentType extends ImageEntityType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Segment::class;
	}
}