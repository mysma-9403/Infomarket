<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\User;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class UserManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var User $entry */
		
		$entry->setUsername($request->get('username'));
		$entry->setForename($request->get('forename'));
		$entry->setSurname($request->get('surname'));
		
		$entry->setPseudonym($request->get('pseudonym'));
		
		$entry->setEmail($request->get('email'));
		
		return $entry;
	}

	/**
	 *
	 * @param User $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var User $entry */
		
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