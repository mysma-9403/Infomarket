<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Menu;
use AppBundle\Repository\Base\BaseEntityRepository;

class MenuRepository extends BaseEntityRepository
{
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Menu::class ;
	}
}
