<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Filter\ArticleTagAssignmentFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class ArticleTagAssignmentFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$articleRepository = $this->doctrine->getRepository(Article::class);
		$tagRepository = $this->doctrine->getRepository(Tag::class);
	
		return new ArticleTagAssignmentFilter($userRepository, $articleRepository, $tagRepository);
	}
}