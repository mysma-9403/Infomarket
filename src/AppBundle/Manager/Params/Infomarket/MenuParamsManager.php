<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuEntry;
use AppBundle\Manager\Params\Base\ParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Infomarket\MenuEntryRepository;

class MenuParamsManager extends ParamsManager {
	
	public function getParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		$em = $this->doctrine->getManager();
		
		/** @var MenuEntryRepository $menuEntryRepository */
		$menuEntryRepository = new MenuEntryRepository($em, $em->getClassMetadata(MenuEntry::class));
    	
    	$branchId = $contextParams['branch'];
    	
    	$menuEntries = $menuEntryRepository->findMenuItems(Menu::FOOTER_MENU, $branchId);
    	$viewParams['footerMenuEntries'] = $menuEntries;
    	
    	$menuEntries = $menuEntryRepository->findMenuItems(Menu::MAIN_MENU, $branchId);
    	$viewParams['mainMenuEntries'] = $menuEntries;
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}