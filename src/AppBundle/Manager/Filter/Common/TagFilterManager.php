<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\TagFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class TagFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	
    	return new TagFilter($userRepository);
	}
}