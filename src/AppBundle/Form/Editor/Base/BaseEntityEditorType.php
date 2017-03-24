<?php

namespace AppBundle\Form\Editor\Base;

use AppBundle\Entity\Base\Audit;
use AppBundle\Form\Base\EditorType;

class BaseEntityEditorType extends EditorType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseType::getEntityType()
	 */
	protected function getEntityType() {
		return Audit::class;
	}
}