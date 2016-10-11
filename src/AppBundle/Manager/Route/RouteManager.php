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
		 
		$session->set('curr_route', !$this->isRestricted($newRoute) ? $newRoute : null);
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
		if(strpos($newRoute['route'], '_new') !== false) {
			return true;
		}
		 
		if(strpos($newRoute['route'], '_copy') !== false) {
			return true;
		}
		 
		if(strpos($newRoute['route'], '_delete') !== false) {
			return true;
		}
	
		return false;
	}
	
	public function getLastRoute(Request $request, $template) {
		//TODO route stacks
		return $request->getSession()->get('curr_route', $template);
	}
	
	public function removeLastRoute(Request $request) {
		//TODO 
	}
	
	public function redirectToReferer(Request $request) {
		$referer = $request->headers->get('referer');
		return $this->redirect($referer);
	}
}