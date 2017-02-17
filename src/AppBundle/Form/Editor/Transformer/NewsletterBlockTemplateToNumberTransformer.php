<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\NewsletterBlockTemplate;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class NewsletterBlockTemplateToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (newsletterBlockTemplate) to a number (id).
	 *
	 * @param  NewsletterBlockTemplate|null $newsletterBlockTemplate
	 * @return integer
	 */
	public function transform($newsletterBlockTemplate)
	{
		if (null === $newsletterBlockTemplate) {
			return 0;
		}
		return $newsletterBlockTemplate->getId();
	}

	/**
	 * Transforms a number (id) to an object (newsletterBlockTemplate).
	 *
	 * @param  string $newsletterBlockTemplateId
	 * @return NewsletterBlockTemplate|null
	 * @throws TransformationFailedException if object (newsletterBlockTemplate) is not found.
	 */
	public function reverseTransform($newsletterBlockTemplateId)
	{
		if (!$newsletterBlockTemplateId) {
			return;
		}

		$newsletterBlockTemplate = $this->em->getRepository(NewsletterBlockTemplate::class)->find($newsletterBlockTemplateId);

		if (null === $newsletterBlockTemplate) {
			throw new TransformationFailedException(sprintf('An newsletterBlockTemplate with id "%s" does not exist!', $newsletterBlockTemplateId));
		}

		return $newsletterBlockTemplate;
	}
}