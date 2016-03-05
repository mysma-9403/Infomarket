<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Form\Lists\Base\ImageTreeListType;

abstract class ImageTreeController extends ImageEntityController {
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\ImageEntityController::getListFormType()
	 */
	protected function getListFormType() {
		return ImageTreeListType::class;
	}
}