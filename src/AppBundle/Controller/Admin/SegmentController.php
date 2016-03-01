<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Lists\SegmentList;
use AppBundle\Entity\Segment;
use AppBundle\Form\SegmentType;
use AppBundle\Form\SegmentListType;

class SegmentController extends SimpleEntityController {
	
	/**
	 * {@inheritDoc}
	 */
	protected function getEntityType() {
		return 'AppBundle:Segment';
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getEntityClass() {
		return Segment::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getEntityListClass() {
		return SegmentList::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getFormClass() {
		return SegmentType::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getListFormClass() {
		return SegmentListType::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getTwigName() {
		return 'segment';
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function createNewList() {
		return new SegmentList();
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function createNewEntry() {
		return new Segment();
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getIndexRoute() {
		return 'admin_segments';
	}
}