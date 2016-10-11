<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\TagFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class TagFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	
    	return new TagFilter($userRepository);
	}
}