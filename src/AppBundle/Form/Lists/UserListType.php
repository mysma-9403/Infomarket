<?php

namespace AppBundle\Form\Lists;

use AppBundle\Entity\User;
use AppBundle\Form\Lists\Base\BaseEntityListType;

class UserListType extends BaseEntityListType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Lists\Base\BaseEntityListType::getChoiceType()
	 */
	protected function getChoiceType() {
		return User::class; //TODO remove - not needed>>
	}
}