<?php

namespace AppBundle\Form;

use AppBundle\Form\Base\SimpleEntityListType;
use AppBundle\Entity\Lists\BranchList;

class BranchListType extends SimpleEntityListType {
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return 'AppBundle:Branch';
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityListClass() {
		return BranchList::class;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityListName() {
		return 'branch_list';
	}
}