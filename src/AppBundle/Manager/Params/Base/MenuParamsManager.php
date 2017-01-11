<?php

namespace AppBundle\Manager\Params\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\MenuEntryFilter;
use AppBundle\Entity\Link;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\Page;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\Base\ParamsManager;
use Symfony\Component\HttpFoundation\Request;

class MenuParamsManager extends ParamsManager {
	
	protected $infomarket;
	protected $infoprodukt;
	
	public function __construct($doctrine) {
		parent::__construct($doctrine);
		
		$this->infomarket = false;
		$this->infoprodukt = false;
	}
	
	public function getParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
		
		
		$userRepository = $this->doctrine->getRepository(User::class); //TODO bedzie usuniete
		$pageRepository = $this->doctrine->getRepository(Page::class);
		$linkRepository = $this->doctrine->getRepository(Link::class);
		$menuEntryRepository = $this->doctrine->getRepository(MenuEntry::class);
		
		$menuEntryFilter = new MenuEntryFilter($userRepository, $menuEntryRepository, $pageRepository, $linkRepository);
    	if($this->infomarket) $menuEntryFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
    	if($this->infoprodukt) $menuEntryFilter->setInfoprodukt(BaseEntityFilter::TRUE_VALUES);
    	$menuEntryFilter->setRoot(BaseEntityFilter::TRUE_VALUES);
    	$menuEntryFilter->setOrderBy('e.orderNumber ASC');
    	
    	$menuEntryFilter->setMenus(array(MenuEntry::FOOTER_MENU));
    	$menuEntries = $this->getParamList(MenuEntry::class, $menuEntryFilter);
    	$menuEntries = $this->prepareMenuEntries($menuEntries, $menuEntryFilter);
    	$viewParams['footerMenuEntries'] = $menuEntries;
    	
    	
    	$menuEntryFilter->setRoot(BaseEntityFilter::TRUE_VALUES);
    	$menuEntryFilter->setParents([]);
    	
    	$menuEntryFilter->setMenus(array(MenuEntry::MAIN_MENU));
    	$menuEntries = $this->getParamList(MenuEntry::class, $menuEntryFilter);
    	$menuEntries = $this->prepareMenuEntries($menuEntries, $menuEntryFilter);
    	$viewParams['mainMenuEntries'] = $menuEntries;
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
	
	protected function prepareMenuEntries(array $entries, MenuEntryFilter $menuEntryFilter) {
		$menuEntryFilter->setRoot(BaseEntityFilter::FALSE_VALUES);
		
		foreach ($entries as $entry) {
			$menuEntryFilter->setParents([$entry]);
				
			$subentries = $this->getParamList(MenuEntry::class, $menuEntryFilter);
			$subentries = $this->prepareMenuEntries($subentries, $menuEntryFilter);
				
			$entry->setMenuChildren($subentries);
		}
	
		return $entries;
	}
}