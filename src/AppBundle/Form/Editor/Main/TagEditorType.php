<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Tag;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;

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