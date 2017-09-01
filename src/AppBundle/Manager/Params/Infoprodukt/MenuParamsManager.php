<?php

namespace AppBundle\Manager\Params\Infoprodukt;

use AppBundle\Entity\Menu;
use AppBundle\Repository\Infoprodukt\MenuEntryRepository;
use Symfony\Component\HttpFoundation\Request;

class MenuParamsManager {
	
	/**
	 *
	 * @var MenuEntryRepository
	 */
	protected $menuEntryRepository;
	
	public function __construct(MenuEntryRepository $menuEntryRepository) {
		$this->menuEntryRepository = $menuEntryRepository;
	}
	
	public function getParams(Request $request, array $params) {
// 		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
    	
    	$categories = array(); //TODO improve context categories $contextParams['categories'];
    	
    	$menuEntries = $this->menuEntryRepository->findMenuItems(Menu::FOOTER_MENU, $categories);
    	$viewParams['footerMenuEntries'] = $menuEntries;
    	
    	$menuEntries = $this->menuEntryRepository->findMenuItems(Menu::MAIN_MENU, $categories);
    	$viewParams['mainMenuEntries'] = $menuEntries;
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}