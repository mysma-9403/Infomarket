<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt\Base;

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

	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		$viewParams = $params['viewParams'];
		
		$viewParams['route'] = $this->getRoute($request, $params, $id);
		
		$params['viewParams'] = $viewParams;
		return $params;
	}

	protected function getRoute(Request $request, array $params, $page) {
		$contextParams = $params['contextParams'];
		$category = $contextParams['category'];
		
		// $route = $request->getPathInfo();
		$route = $request->getRequestUri();
		if ($category && strpos($route, 'category') === false) {
			$route .= strpos($route, '?') === false ? '?' : '&';
			$route .= 'category=' . $category;
		}
		
		return $route;
	}
}