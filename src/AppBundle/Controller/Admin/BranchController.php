<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Lists\BranchList;
use AppBundle\Form\BranchType;
use AppBundle\Form\BranchListType;

class BranchController extends SimpleEntityController {
	
	/**
	 * {@inheritDoc}
	 */
	protected function getEntityType() {
		return 'AppBundle:Branch';
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getEntityClass() {
		return Branch::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getEntityListClass() {
		return BranchList::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getFormClass() {
		return BranchType::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getListFormClass() {
		return BranchListType::class;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getTwigName() {
		return 'branch';
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function createNewList() {
		return new BranchList();
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function createNewEntry() {
		return new Branch();
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getIndexRoute() {
		return 'admin_branches';
	}
}