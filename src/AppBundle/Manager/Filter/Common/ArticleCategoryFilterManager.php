<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\ArticleCategoryFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class ArticleCategoryFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
	
		return new ArticleCategoryFilter($userRepository);
	}
}