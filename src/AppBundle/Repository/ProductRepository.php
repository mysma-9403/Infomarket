<?php

namespace AppBundle\Repository;

use AppBundle\Repository\Base\BaseEntityRepository;
use AppBundle\Entity\Product;

class ProductRepository extends BaseEntityRepository
{
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Product::class ;
	}
}
