<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Brand;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;

class BrandRepository extends SimpleEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Brand::class;
	}
}
