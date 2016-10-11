<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleCategoryAssignmentFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class ArticleCategoryAssignmentFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$articleRepository = $this->doctrine->getRepository(Article::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
	
		return new ArticleCategoryAssignmentFilter($userRepository, $articleRepository, $categoryRepository);
	}
}