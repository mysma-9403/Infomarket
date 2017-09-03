<?php

namespace AppBundle\Security\Base;

use AppBundle\Entity\Base\Simple;
use AppBundle\Entity\Main\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BaseVoter extends Voter {

	const SHOW = 'show';

	const EDIT = 'edit';

	const DELETE = 'delete';

	protected function supports($attribute, $object) {
		if (! in_array($attribute, array (self::SHOW,self::EDIT,self::DELETE 
		))) {
			return false;
		}
		
		if (! $object instanceof Simple) {
			return false;
		}
		
		return true;
	}

	protected function voteOnAttribute($attribute, $object, TokenInterface $token) {
		$user = $token->getUser();
		
		if (! self::isLoggedIn($user)) {
			return false;
		}
		
		/** @var Simple $entry */
		$entry = $object;
		
		switch ($attribute) {
			case self::SHOW:
				return true;
			case self::EDIT:
			case self::DELETE:
				return $this->canEdit($entry, $user);
		}
		
		return false;
	}

	protected function isLoggedIn($user) {
		return $user instanceof User;
	}

	protected function canEdit(Simple $entry, User $user) {
		return $user->getId() === $entry->getCreatedBy()->getId();
	}
}