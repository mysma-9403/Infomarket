<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\User;
use AppBundle\Factory\Common\Choices\Base\AbstractChoicesFactory;

class UserRolesFactory extends AbstractChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				$this->translator->trans('label.user.role.guest') => User::ROLE_DEFAULT,
				$this->translator->trans('label.user.role.editor') => User::ROLE_EDITOR,
				$this->translator->trans('label.user.role.publisher') => User::ROLE_PUBLISHER,
				$this->translator->trans('label.user.role.ratingEditor') => User::ROLE_RATING_EDITOR,
				$this->translator->trans('label.user.role.admin') => User::ROLE_ADMIN,
				$this->translator->trans('label.user.role.superAdmin') => User::ROLE_SUPER_ADMIN
		];
	}
	
}