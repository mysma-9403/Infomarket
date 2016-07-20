<?php

namespace KrkDev\Bundle\RoutingBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;

class Kernel {

	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $router;

	public function __construct(\Symfony\Component\Routing\Router $router) {
		$this->router = $router;
	}

	public function onKernelRequest(GetResponseEvent $event) {
// 		if ($event->getRequestType() !== \Symfony\Component\HttpKernel\HttpKernel::MASTER_REQUEST) {
// 			return;
// 		}

// 		/** @var \Symfony\Component\HttpFoundation\Request $request  */
// 		$request = $event->getRequest();
// 		/** @var \Symfony\Component\HttpFoundation\Session $session  */
// 		$session = $request->getSession();

// 		$routeParams = $this->router->match($request->getPathInfo());
// 		$routeName = $routeParams['_route'];
// 		if ($routeName[0] == '_') {
// 			return;
// 		}
		
// 		unset($routeParams['_route']);
// 		$routeData = array('route' => $routeName, 'routeParams' => $routeParams);

// 		//Skipping duplicates
// 		$thisRoute = $session->get('this_route', array());
// 		if ($this->isDuplicate($thisRoute, $routeData) === true) {
// // 			throw new InvalidArgumentException($routeData['route'] . ':' . count($routeData['routeParams']) . ', ' . $thisRoute['route'] . ':' . count($thisRoute['routeParams']));
// 			return;
// 		}
		
// 		if ($this->isRestricted($routeData)) {
// 			return;
// 		}
		
// 		$session->set('last_route', $thisRoute);
// 		$session->set('this_route', $routeData);
	}
	
	protected function isDuplicate($thisRoute, $routeData) {
		if($thisRoute['route'] != $routeData['route']) {
			return false;
		}
		
		$thisRouteParams = $thisRoute['routeParams'];
		$routeDataParams = $routeData['routeParams'];
		
		$count = count($thisRouteParams);
		
		if($count != count($routeDataParams)) {
			return  false;
		}
		
		foreach(array_keys($thisRouteParams) as $key) {
			if(!array_key_exists($key, $routeDataParams)) {
				return false;
			}
			
			if($thisRouteParams[$key] != $routeDataParams[$key]) {
				return false;
			}
		}
			
		return false;
	}
	
	protected function isRestricted($routeData) {
		if(strpos($routeData['route'], '_new') !== false) {
			return true;
		}
		
		return false;
	}
}