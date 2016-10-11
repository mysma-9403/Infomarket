<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\TermCategoryAssignmentFilter;
use AppBundle\Entity\Term;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class TermCategoryAssignmentFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$termRepository = $this->doctrine->getRepository(Term::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
	
		return new TermCategoryAssignmentFilter($userRepository, $termRepository, $categoryRepository);
	}
}