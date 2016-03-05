<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Form\Lists\Base\ImageTreeListType;

abstract class SimpleTreeController extends SimpleEntityController {
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getListFormType()
	 */
	protected function getListFormType() {
		return ImageTreeListType::class;
	}
}