<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\NewsletterBlockTemplateFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class NewsletterBlockTemplateFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
    	
    	return new NewsletterBlockTemplateFilter($userRepository);
	}
}