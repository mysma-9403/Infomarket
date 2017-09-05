<?php

namespace AppBundle\Repository\Common;

use AppBundle\Entity\Main\Brand;
use AppBundle\Repository\Base\BaseRepository;

class BrandRepository extends BaseRepository {

	protected function getEntityType() {
		return Brand::class;
	}
}
