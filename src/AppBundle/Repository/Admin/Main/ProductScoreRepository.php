<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\ProductScore;
use AppBundle\Repository\Base\BaseRepository;

class ProductScoreRepository extends BaseRepository {

	protected function getEntityType() {
		return ProductScore::class;
	}
}
