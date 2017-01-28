<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\Filter\NewsletterBlockArticleAssignmentFilter;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class NewsletterBlockArticleAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$newsletterBlockRepository = $this->doctrine->getRepository(NewsletterBlock::class);
		$articleRepository = $this->doctrine->getRepository(Article::class);
	
		return new NewsletterBlockArticleAssignmentFilter($userRepository, $newsletterBlockRepository, $articleRepository);
	}
}