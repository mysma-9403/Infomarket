<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\MenuEntryFilter;
use AppBundle\Entity\Link;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\Page;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class MenuEntryFilterManager extends BaseEntityFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$pageRepository = $this->doctrine->getRepository(Page::class);
		$linkRepository = $this->doctrine->getRepository(Link::class);
		$menuEntryRepository = $this->doctrine->getRepository(MenuEntry::class);
		
		return new MenuEntryFilter($userRepository, $menuEntryRepository, $pageRepository, $linkRepository);
	}
}