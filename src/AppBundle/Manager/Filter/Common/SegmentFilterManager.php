<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\SegmentFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class SegmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	
    	return new SegmentFilter($userRepository);
	}
}