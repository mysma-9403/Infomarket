<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\MenuFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class MenuFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		
		return new MenuFilter($userRepository);
	}
}