<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\User;
use AppBundle\Factory\Item\Base\ItemFactory;

class UserFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(User::class);
	}
}