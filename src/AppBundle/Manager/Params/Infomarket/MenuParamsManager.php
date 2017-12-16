<?php

namespace AppBundle\Manager\Params\Infomarket;

use AppBundle\Entity\Main\Menu;
use AppBundle\Repository\Infomarket\MenuEntryRepository;
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
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		$branchId = $contextParams['branch'];
		if ($branchId) {
			$menuEntries = $this->menuEntryRepository->findMenuItems(Menu::FOOTER_MENU, $branchId);
			$viewParams['footerMenuEntries'] = $menuEntries;
			
			$menuEntries = $this->menuEntryRepository->findMenuItems(Menu::MAIN_MENU, $branchId);
			$viewParams['mainMenuEntries'] = $menuEntries;
		}
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}