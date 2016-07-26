<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Magazine;
use AppBundle\Repository\Base\BaseEntityRepository;

class MagazineRepository extends BaseEntityRepository
{	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Magazine::class ;
	}
}
