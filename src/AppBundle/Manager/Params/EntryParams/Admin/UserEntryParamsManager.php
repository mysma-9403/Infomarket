<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;

class UserEntryParamsManager extends EntryParamsManager {
	
	protected $tokenStorage;
	
	public function __construct($em, $fm, $doctrine, $tokenStorage) {
		parent::__construct($em, $fm, $doctrine);
		
		$this->tokenStorage = $tokenStorage;
	}
	
	public function getSettingsParams(Request $request, array $params) {
		$viewParams = $params['viewParams'];
		
		$entry = $this->tokenStorage->getToken()->getUser();
		$viewParams['entry'] = $entry;
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
}