<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\UserFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class UserFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	
    	return new UserFilter($userRepository);
	}
}