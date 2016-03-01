<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use AppBundle\Repository\Base\BaseEntityRepository;

class UserRepository extends BaseEntityRepository
{
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return User::class;
	}
}