<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Menu;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;

class MenuManager extends SimpleEntityManager {
	
	protected function getEntityType() {
		return Menu::class;
	}
}