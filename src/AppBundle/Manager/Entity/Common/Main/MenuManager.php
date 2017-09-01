<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Menu;
use AppBundle\Manager\Entity\Base\EntityManager;

class MenuManager extends EntityManager {

	protected function getEntityType() {
		return Menu::class;
	}
}