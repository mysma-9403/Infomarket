<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Filter\ArticleArticleCategoryAssignmentFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class ArticleArticleCategoryAssignmentFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$articleRepository = $this->doctrine->getRepository(Article::class);
		$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
	
		return new ArticleArticleCategoryAssignmentFilter($userRepository, $articleRepository, $articleCategoryRepository);
	}
}