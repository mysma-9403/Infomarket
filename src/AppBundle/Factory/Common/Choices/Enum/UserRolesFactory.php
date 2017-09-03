<?php

namespace AppBundle\Factory\Common\Choices\Enum;

use AppBundle\Entity\Main\User;
use AppBundle\Factory\Common\Choices\Base\TwigChoicesFactory;

class UserRolesFactory extends TwigChoicesFactory {

	public function __construct() {
		$this->items['label.user.role.guest'] = User::ROLE_DEFAULT;
		$this->items['label.user.role.editor'] = User::ROLE_EDITOR;
		$this->items['label.user.role.publisher'] = User::ROLE_PUBLISHER;
		$this->items['label.user.role.ratingEditor'] = User::ROLE_RATING_EDITOR;
		$this->items['label.user.role.admin'] = User::ROLE_ADMIN;
		$this->items['label.user.role.superAdmin'] = User::ROLE_SUPER_ADMIN;
	}

	protected function getTwigFunctionName() {
		return 'userRoleName';
	}
}