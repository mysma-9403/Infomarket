<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Menu;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;

class MenuRepository extends SimpleEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Menu::class;
	}
}
