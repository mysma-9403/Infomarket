<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Magazine;
use AppBundle\Entity\Filter\NewsletterBlockMagazineAssignmentFilter;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class NewsletterBlockMagazineAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$newsletterBlockRepository = $this->doctrine->getRepository(NewsletterBlock::class);
		$magazineRepository = $this->doctrine->getRepository(Magazine::class);
	
		return new NewsletterBlockMagazineAssignmentFilter($userRepository, $newsletterBlockRepository, $magazineRepository);
	}
}