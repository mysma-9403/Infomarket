<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\MenuEntryCategoryAssignmentFilter;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class MenuEntryCategoryAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$menuEntryRepository = $this->doctrine->getRepository(MenuEntry::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
	
		return new MenuEntryCategoryAssignmentFilter($userRepository, $menuEntryRepository, $categoryRepository);
	}
}