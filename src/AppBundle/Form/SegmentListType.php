<?php

namespace AppBundle\Form;

use AppBundle\Form\Base\SimpleEntityListType;
use AppBundle\Entity\Lists\SegmentList;

class SegmentListType extends SimpleEntityListType {
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return 'AppBundle:Segment';
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityListClass() {
		return SegmentList::class;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityListName() {
		return 'segment_list';
	}
}