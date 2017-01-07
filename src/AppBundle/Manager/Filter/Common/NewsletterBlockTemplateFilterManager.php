<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\NewsletterBlockTemplateFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class NewsletterBlockTemplateFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	
    	return new NewsletterBlockTemplateFilter($userRepository);
	}
}