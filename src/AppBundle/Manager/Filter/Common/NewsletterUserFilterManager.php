<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\NewsletterUserFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class NewsletterUserFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	
    	return new NewsletterUserFilter($userRepository);
	}
}