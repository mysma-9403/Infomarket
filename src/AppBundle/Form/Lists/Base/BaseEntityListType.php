<?php

namespace AppBundle\Form\Lists\Base;

use AppBundle\Entity\Lists\Base\BaseEntityList;
use AppBundle\Form\Base\ListType;

class BaseEntityListType extends ListType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::getEntityType()
	 */
	protected function getEntityType() {
		return BaseEntityList::class;
	}
}