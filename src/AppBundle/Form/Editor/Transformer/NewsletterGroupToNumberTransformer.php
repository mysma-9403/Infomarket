<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\NewsletterGroup;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class NewsletterGroupToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (newsletterGroup) to a number (id).
	 *
	 * @param  NewsletterGroup|null $newsletterGroup
	 * @return integer
	 */
	public function transform($newsletterGroup)
	{
		if (null === $newsletterGroup) {
			return 0;
		}
		return $newsletterGroup->getId();
	}

	/**
	 * Transforms a number (id) to an object (newsletterGroup).
	 *
	 * @param  string $newsletterGroupId
	 * @return NewsletterGroup|null
	 * @throws TransformationFailedException if object (newsletterGroup) is not found.
	 */
	public function reverseTransform($newsletterGroupId)
	{
		if (!$newsletterGroupId) {
			return;
		}

		$newsletterGroup = $this->em->getRepository(NewsletterGroup::class)->find($newsletterGroupId);

		if (null === $newsletterGroup) {
			throw new TransformationFailedException(sprintf('An newsletterGroup with id "%s" does not exist!', $newsletterGroupId));
		}

		return $newsletterGroup;
	}
}