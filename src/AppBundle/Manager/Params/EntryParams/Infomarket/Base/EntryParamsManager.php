<?php

namespace AppBundle\Manager\Params\EntryParams\Infomarket\Base;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager as BaseEntryParamsManager;

class EntryParamsManager extends BaseEntryParamsManager {

	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		$viewParams = $params['viewParams'];
		
		$viewParams['route'] = $this->getRoute($request, $params, $page);
		
		$params['viewParams'] = $viewParams;
		return $params;
	}

	public function getShowParams(Request $request, array $params, $id, $category = null) {
		$params = parent::getShowParams($request, $params, $id);
		$viewParams = $params['viewParams'];
		
		$viewParams['route'] = $this->getRoute($request, $params, $id);
		
		$params['viewParams'] = $viewParams;
		return $params;
	}

	protected function getRoute(Request $request, array $params, $page) {
		$route = $request->getRequestUri();
		
		$contextParams = $params['contextParams'];
		$branch = $contextParams['branch'];
		if ($branch > 0) {
			if (strpos($route, 'branch') === false) {
				$route .= strpos($route, '?') === false ? '?' : '&';
				$route .= 'branch=' . $branch;
			}
		}
		
		return $route;
	}
}
