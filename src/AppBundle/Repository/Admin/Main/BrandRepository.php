<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Brand;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;

class BrandRepository extends ImageEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Brand::class;
	}
}
