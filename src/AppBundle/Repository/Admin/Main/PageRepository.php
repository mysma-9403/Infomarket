<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Page;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;

class PageRepository extends SimpleEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Page::class;
	}
}
