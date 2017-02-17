<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Branch;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;

class BranchRepository extends ImageEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Branch::class;
	}
}
