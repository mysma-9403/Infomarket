<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\NewsletterPageTemplateFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class NewsletterPageTemplateFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	
    	return new NewsletterPageTemplateFilter($userRepository);
	}
}