<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\User;
use AppBundle\Factory\Common\Choices\Base\ChoicesFactory;

class UserRolesFactory implements ChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				'label.user.role.guest' => User::ROLE_DEFAULT,
				'label.user.role.editor' => User::ROLE_EDITOR,
				'label.user.role.publisher' => User::ROLE_PUBLISHER,
				'label.user.role.ratingEditor' => User::ROLE_RATING_EDITOR,
				'label.user.role.admin' => User::ROLE_ADMIN,
				'label.user.role.superAdmin' => User::ROLE_SUPER_ADMIN
		];
	}
	
}