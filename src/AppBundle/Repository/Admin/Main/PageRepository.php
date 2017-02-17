<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Page;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;

class PageRepository extends ImageEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Page::class;
	}
}
