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

	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.id_list_items_provider');
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getFilterManager($doctrine) {
		return new FilterManager(new BaseFilter());
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function createNewList() {
		return new BaseList();
	}

	protected function getListFormType() {
		return BaseListType::class;
	}
}