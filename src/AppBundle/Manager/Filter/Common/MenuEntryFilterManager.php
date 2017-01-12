<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\MenuEntryFilter;
use AppBundle\Entity\Link;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\Page;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;
use AppBundle\Entity\Menu;

class MenuEntryFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$menuRepository = $this->doctrine->getRepository(Menu::class);
		$pageRepository = $this->doctrine->getRepository(Page::class);
		$linkRepository = $this->doctrine->getRepository(Link::class);
		$menuEntryRepository = $this->doctrine->getRepository(MenuEntry::class);
		
		return new MenuEntryFilter($userRepository, $menuEntryRepository, $menuRepository, $pageRepository, $linkRepository);
	}
}