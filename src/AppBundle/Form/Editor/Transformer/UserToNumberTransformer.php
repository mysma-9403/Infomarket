<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class UserToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (user) to a number (id).
	 *
	 * @param  User|null $user
	 * @return integer
	 */
	public function transform($user)
	{
		if (null === $user) {
			return 0;
		}
		return $user->getId();
	}

	/**
	 * Transforms a number (id) to an object (user).
	 *
	 * @param  string $userId
	 * @return User|null
	 * @throws TransformationFailedException if object (user) is not found.
	 */
	public function reverseTransform($userId)
	{
		if (!$userId) {
			return;
		}

		$user = $this->em->getRepository(User::class)->find($userId);

		if (null === $user) {
			throw new TransformationFailedException(sprintf('An user with id "%s" does not exist!', $userId));
		}

		return $user;
	}
}