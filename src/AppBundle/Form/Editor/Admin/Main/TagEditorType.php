<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Tag;
use AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorType;

class TagEditorType extends SimpleEntityEditorType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Tag::class;
	}
}