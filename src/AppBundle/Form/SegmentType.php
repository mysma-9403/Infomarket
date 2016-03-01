<?php

namespace AppBundle\Form;

use AppBundle\Form\Base\SimpleEntityType;
use AppBundle\Entity\Segment;

class SegmentType extends SimpleEntityType
{
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityClass() {
		return Segment::class;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityName() {
		return 'segment';
	}
}