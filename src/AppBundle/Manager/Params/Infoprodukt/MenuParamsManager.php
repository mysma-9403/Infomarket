<?php

namespace AppBundle\Manager\Params\Infoprodukt;

use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuEntry;
use AppBundle\Manager\Params\Base\ParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Infoprodukt\MenuEntryRepository;

class MenuParamsManager extends ParamsManager {
	
	public function getParams(Request $request, array $params) {
// 		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		$em = $this->doctrine->getManager();
		
		/** @var MenuEntryRepository $menuEntryRepository */
		$menuEntryRepository = new MenuEntryRepository($em, $em->getClassMetadata(MenuEntry::class));
    	
    	$categories = array(); //TODO improve context categories $contextParams['categories'];
    	
    	$menuEntries = $menuEntryRepository->findMenuItems(Menu::FOOTER_MENU, $categories);
    	$viewParams['footerMenuEntries'] = $menuEntries;
    	
    	$menuEntries = $menuEntryRepository->findMenuItems(Menu::MAIN_MENU, $categories);
    	$viewParams['mainMenuEntries'] = $menuEntries;
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}