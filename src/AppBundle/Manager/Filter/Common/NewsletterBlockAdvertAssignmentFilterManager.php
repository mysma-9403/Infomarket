<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Filter\NewsletterBlockAdvertAssignmentFilter;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class NewsletterBlockAdvertAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$newsletterBlockRepository = $this->doctrine->getRepository(NewsletterBlock::class);
		$advertRepository = $this->doctrine->getRepository(Advert::class);
	
		return new NewsletterBlockAdvertAssignmentFilter($userRepository, $newsletterBlockRepository, $advertRepository);
	}
}