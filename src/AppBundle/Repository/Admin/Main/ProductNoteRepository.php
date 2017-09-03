<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\ProductNote;
use AppBundle\Repository\Base\BaseRepository;

class ProductNoteRepository extends BaseRepository {

	protected function getEntityType() {
		return ProductNote::class;
	}
}
