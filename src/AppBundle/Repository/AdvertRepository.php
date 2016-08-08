<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Advert;
use AppBundle\Repository\Base\BaseEntityRepository;

class AdvertRepository extends BaseEntityRepository
{
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Advert::class ;
	}
}
