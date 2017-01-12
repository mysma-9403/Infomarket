<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Filter\MagazineBranchAssignmentFilter;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class MagazineBranchAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$magazineRepository = $this->doctrine->getRepository(Magazine::class);
		$branchRepository = $this->doctrine->getRepository(Branch::class);
	
		return new MagazineBranchAssignmentFilter($userRepository, $magazineRepository, $branchRepository);
	}
}