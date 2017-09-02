<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Entity\Lists\Base\BaseEntityList;
use AppBundle\Entity\User;
use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Form\Lists\Base\BaseEntityListType;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseEntityController extends AdminController {
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
		
		$this->addEntityChoicesFormOption($options, User::class, 'createdBy');
		$this->addEntityChoicesFormOption($options, User::class, 'updatedBy');
		
		return $options;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		return new FilterManager(new BaseFilter());
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function createNewList() {
		return new BaseEntityList();
	}

	/**
	 *
	 * @return BaseEntityListType
	 */
	protected function getListFormType() {
		return BaseEntityListType::class;
	}
}