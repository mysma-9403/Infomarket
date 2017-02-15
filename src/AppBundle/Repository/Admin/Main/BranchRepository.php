<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Branch;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;

class BranchRepository extends SimpleEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Branch::class;
	}
}
