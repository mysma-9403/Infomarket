<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Tag;
use AppBundle\Repository\Base\BaseEntityRepository;

class TagRepository extends BaseEntityRepository
{
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Tag::class ;
	}
}
