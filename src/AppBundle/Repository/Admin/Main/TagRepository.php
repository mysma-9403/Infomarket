<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Tag;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;

class TagRepository extends SimpleEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Tag::class;
	}
}
