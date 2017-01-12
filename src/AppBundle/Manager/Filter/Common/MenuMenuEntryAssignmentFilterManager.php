<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\MenuMenuEntryAssignmentFilter;
use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class MenuMenuEntryAssignmentFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$menuRepository = $this->doctrine->getRepository(Menu::class);
		$menuEntryRepository = $this->doctrine->getRepository(MenuEntry::class);
	
		return new MenuMenuEntryAssignmentFilter($userRepository, $menuEntryRepository, $menuRepository);
	}
}