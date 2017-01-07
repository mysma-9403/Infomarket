<?php

namespace AppBundle\Form\Lists\Base;

use AppBundle\Entity\Base\Audit;
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
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ListType::getChoiceType()
	 */
	protected function getChoiceType() {
		return Audit::class;
	}
}