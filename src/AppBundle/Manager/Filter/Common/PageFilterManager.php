<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\PageFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class PageFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	
    	return new PageFilter($userRepository);
	}
}