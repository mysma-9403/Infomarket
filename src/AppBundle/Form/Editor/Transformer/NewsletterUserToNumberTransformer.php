<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\NewsletterUser;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class NewsletterUserToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (newsletterUser) to a number (id).
	 *
	 * @param  NewsletterUser|null $newsletterUser
	 * @return integer
	 */
	public function transform($newsletterUser)
	{
		if (null === $newsletterUser) {
			return 0;
		}
		return $newsletterUser->getId();
	}

	/**
	 * Transforms a number (id) to an object (newsletterUser).
	 *
	 * @param  string $newsletterUserId
	 * @return NewsletterUser|null
	 * @throws TransformationFailedException if object (newsletterUser) is not found.
	 */
	public function reverseTransform($newsletterUserId)
	{
		if (!$newsletterUserId) {
			return;
		}

		$newsletterUser = $this->em->getRepository(NewsletterUser::class)->find($newsletterUserId);

		if (null === $newsletterUser) {
			throw new TransformationFailedException(sprintf('An newsletterUser with id "%s" does not exist!', $newsletterUserId));
		}

		return $newsletterUser;
	}
}