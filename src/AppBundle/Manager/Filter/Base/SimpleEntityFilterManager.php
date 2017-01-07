<?php

namespace AppBundle\Manager\Filter\Base;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\User;

class SimpleEntityFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		
		return new SimpleEntityFilter($userRepository);
	}
}