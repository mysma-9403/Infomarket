<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\ProductValue;
use AppBundle\Repository\Base\BaseRepository;

class ProductValueRepository extends BaseRepository {

	protected function getEntityType() {
		return ProductValue::class;
	}
}
