<?php

namespace AppBundle\Manager\Route;

use Symfony\Component\HttpFoundation\Request;

class RouteManager {
	
	public function register(Request $request, $route, $routeParams) {
		$session = $request->getSession();
		 
		$currRoute = $session->get('curr_route', null);
		$newRoute = array('route' => $route, 'routeParams' => $routeParams);
		 
		if($currRoute != null && $this->isDuplicate($currRoute, $newRoute)) {
			return;
		}
		 
		if($currRoute != null) {
			$session->set('last_route', $currRoute);
		}
		
		if(!$this->isRestricted($newRoute)) {
			$session->set('curr_route', $newRoute);
		}
	}
	
	public function remove(Request $request, $id) {
		$session = $request->getSession();
			
		$currRoute = $session->get('curr_route', null);
		if($currRoute != null) {
			$routeParams = $currRoute['routeParams'];
			if(array_key_exists('id', $routeParams)) {
				$routeId = $routeParams['id'];
				if($routeId == $id) {
					$session->remove('curr_route');
				}
			}
		}
		
		$lastRoute = $session->get('last_route', null);
		if($lastRoute != null) {
			$routeParams = $lastRoute['routeParams'];
			if(array_key_exists('id', $routeParams)) {
				$routeId = $routeParams['id'];
				if($routeId == $id) {
					$session->remove('last_route');
				}
			}
		}
	}
	
	protected function isDuplicate($currRoute, $newRoute) {
		if($currRoute['route'] != $newRoute['route']) {
			return false;
		}
	
		$currRouteParams = $currRoute['routeParams'];
		$newRouteParams = $newRoute['routeParams'];
	
		$count = count($currRouteParams);
	
		if($count != count($newRouteParams)) {
			return  false;
		}
	
		foreach(array_keys($currRouteParams) as $key) {
			if(!array_key_exists($key, $newRouteParams)) {
				return false;
			}
			 
			if($currRouteParams[$key] != $newRouteParams[$key]) {
				return false;
			}
		}
	
		return true;
	}
	
	protected function isRestricted($newRoute) {
		$route = $newRoute['route'];
		$size = strlen($route);
		
		$ending = substr($route, $size - 4, 4);
		if($ending == '_new') {
			return true;
		}
		
		$ending = substr($route, $size - 5, 5);
		if($ending == '_copy') {
			return true;
		}
		
		$ending = substr($route, $size - 7, 7);
		if($ending == '_delete') {
			return true;
		}
	
		return false;
	}
	
	public function getLastRoute(Request $request, $template) {
		//TODO route stacks
		$currRoute = $request->getSession()->get('curr_route', $template);
		return $currRoute;
	}
	
	public function removeLastRoute(Request $request) {
		//TODO 
	}
	
	public function redirectToReferer(Request $request) {
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
}