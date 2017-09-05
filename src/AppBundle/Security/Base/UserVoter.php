<?php

namespace AppBundle\Security\Base;

use AppBundle\Entity\Main\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter {

	const SHOW = 'show';

	const EDIT = 'edit';

	const DELETE = 'delete';

	protected function supports($attribute, $object) {
		if (! in_array($attribute, array (self::SHOW,self::EDIT,self::DELETE 
		))) {
			return false;
		}
		
		if (! $object instanceof User) {
			return false;
		}
		
		return true;
	}

	protected function voteOnAttribute($attribute, $object, TokenInterface $token) {
		$user = $token->getUser();
		
		if (! self::isLoggedIn($user)) {
			return false;
		}
		
		/** @var User $entry */
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

	protected function canEdit(User $entry, User $user) {
		if ($user->isSuperAdmin())
			return true;
		return $user->getId() === $entry->getId();
	}
}