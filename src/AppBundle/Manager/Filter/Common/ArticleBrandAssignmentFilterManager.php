<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Filter\ArticleBrandAssignmentFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class ArticleBrandAssignmentFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$articleRepository = $this->doctrine->getRepository(Article::class);
		$brandRepository = $this->doctrine->getRepository(Brand::class);
	
		return new ArticleBrandAssignmentFilter($userRepository, $articleRepository, $brandRepository);
	}
}