<?php

namespace AppBundle\Repository;

use AppBundle\Repository\Base\BaseEntityRepository;
use AppBundle\Entity\Brand;

class BrandRepository extends BaseEntityRepository
{
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Brand::class ;
	}
}
