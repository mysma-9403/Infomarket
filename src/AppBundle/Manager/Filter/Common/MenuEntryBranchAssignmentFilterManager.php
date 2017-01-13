<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Filter\MenuEntryBranchAssignmentFilter;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class MenuEntryBranchAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$menuEntryRepository = $this->doctrine->getRepository(MenuEntry::class);
		$branchRepository = $this->doctrine->getRepository(Branch::class);
	
		return new MenuEntryBranchAssignmentFilter($userRepository, $menuEntryRepository, $branchRepository);
	}
}