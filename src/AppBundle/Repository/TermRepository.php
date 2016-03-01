<?php

namespace AppBundle\Repository;

use AppBundle\Repository\Base\BaseEntityRepository;
use AppBundle\Entity\Term;

class TermRepository extends BaseEntityRepository
{
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Term::class ;
	}
}
