<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\NewsletterPageTemplate;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class NewsletterPageTemplateToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (newsletterPageTemplate) to a number (id).
	 *
	 * @param  NewsletterPageTemplate|null $newsletterPageTemplate
	 * @return integer
	 */
	public function transform($newsletterPageTemplate)
	{
		if (null === $newsletterPageTemplate) {
			return 0;
		}
		return $newsletterPageTemplate->getId();
	}

	/**
	 * Transforms a number (id) to an object (newsletterPageTemplate).
	 *
	 * @param  string $newsletterPageTemplateId
	 * @return NewsletterPageTemplate|null
	 * @throws TransformationFailedException if object (newsletterPageTemplate) is not found.
	 */
	public function reverseTransform($newsletterPageTemplateId)
	{
		if (!$newsletterPageTemplateId) {
			return;
		}

		$newsletterPageTemplate = $this->em->getRepository(NewsletterPageTemplate::class)->find($newsletterPageTemplateId);

		if (null === $newsletterPageTemplate) {
			throw new TransformationFailedException(sprintf('An newsletterPageTemplate with id "%s" does not exist!', $newsletterPageTemplateId));
		}

		return $newsletterPageTemplate;
	}
}