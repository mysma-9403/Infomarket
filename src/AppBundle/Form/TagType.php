<?php

namespace AppBundle\Form;

use AppBundle\Entity\Tag;
use AppBundle\Form\Base\SimpleEntityType;

class TagType extends SimpleEntityType
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