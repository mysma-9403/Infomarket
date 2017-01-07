<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\User;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class UserManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return User
	 */
	public function createFromRequest(Request $request) {
		/** @var User $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setUsername($request->get('username'));
		$entry->setForename($request->get('forename'));
		$entry->setSurname($request->get('surname'));
		
		$entry->setPseudonym($request->get('pseudonym'));
		
		$entry->setEmail($request->get('email'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param User $template
	 * 
	 * @return User
	 */
	public function createFromTemplate($template) {
		/** @var User $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setUsername($template->getUsername());
		$entry->setForename($template->getForename());
		$entry->setSurname($template->getSurname());
		
		$entry->setPseudonym($template->getPseudonym());
		
		$entry->setEmail($template->getEmail());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return User::class;
	}
}