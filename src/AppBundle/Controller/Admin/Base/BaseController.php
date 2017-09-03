<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Entity\Lists\BaseList;
use AppBundle\Entity\Main\User;
use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Form\Lists\Base\BaseListType;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends AdminController {
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
	 * @see \AppBundle\Controller\Base\BaseController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		return new FilterManager(new BaseFilter());
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function createNewList() {
		return new BaseList();
	}

	/**
	 *
	 * @return BaseListType
	 */
	protected function getListFormType() {
		return BaseListType::class;
	}
}