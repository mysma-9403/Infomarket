<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController {

	/**
	 * 
	 * @var string
	 */
	protected $template;

	/**
	 * 
	 * {@inheritDoc}
	 * @see \FOS\UserBundle\Controller\SecurityController::loginAction()
	 */
	public function loginAction(Request $request) {
		$this->initTemplate($request);
		return parent::loginAction($request);
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \FOS\UserBundle\Controller\SecurityController::renderLogin()
	 */
	protected function renderLogin(array $data) {
		return $this->render($this->template, $data);
	}

	protected function initTemplate(Request $request) {
		$routeName = $request->get('_route');
		
		if (strpos($routeName, 'admin') !== false) {
			$this->template = 'FOSUserBundle:Security:admin_login.html.twig';
		} else if (strpos($routeName, 'benchmark') !== false) {
			$this->template = 'FOSUserBundle:Security:benchmark_login.html.twig';
		} else {
			$this->template = 'FOSUserBundle:Security:login.html.twig';
		}
	}
}
