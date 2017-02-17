<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\NewsletterBlock;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class NewsletterBlockToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (newsletterBlock) to a number (id).
	 *
	 * @param  NewsletterBlock|null $newsletterBlock
	 * @return integer
	 */
	public function transform($newsletterBlock)
	{
		if (null === $newsletterBlock) {
			return 0;
		}
		return $newsletterBlock->getId();
	}

	/**
	 * Transforms a number (id) to an object (newsletterBlock).
	 *
	 * @param  string $newsletterBlockId
	 * @return NewsletterBlock|null
	 * @throws TransformationFailedException if object (newsletterBlock) is not found.
	 */
	public function reverseTransform($newsletterBlockId)
	{
		if (!$newsletterBlockId) {
			return;
		}

		$newsletterBlock = $this->em->getRepository(NewsletterBlock::class)->find($newsletterBlockId);

		if (null === $newsletterBlock) {
			throw new TransformationFailedException(sprintf('An newsletterBlock with id "%s" does not exist!', $newsletterBlockId));
		}

		return $newsletterBlock;
	}
}