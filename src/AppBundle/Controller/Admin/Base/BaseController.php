<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Entity\Lists\BaseList;
use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Form\Lists\Base\BaseListType;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends AdminController {
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getListFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.list');
	}

	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.base');
	}

	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.base');
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
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