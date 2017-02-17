<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\NewsletterPage;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class NewsletterPageToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (newsletterPage) to a number (id).
	 *
	 * @param  NewsletterPage|null $newsletterPage
	 * @return integer
	 */
	public function transform($newsletterPage)
	{
		if (null === $newsletterPage) {
			return 0;
		}
		return $newsletterPage->getId();
	}

	/**
	 * Transforms a number (id) to an object (newsletterPage).
	 *
	 * @param  string $newsletterPageId
	 * @return NewsletterPage|null
	 * @throws TransformationFailedException if object (newsletterPage) is not found.
	 */
	public function reverseTransform($newsletterPageId)
	{
		if (!$newsletterPageId) {
			return;
		}

		$newsletterPage = $this->em->getRepository(NewsletterPage::class)->find($newsletterPageId);

		if (null === $newsletterPage) {
			throw new TransformationFailedException(sprintf('An newsletterPage with id "%s" does not exist!', $newsletterPageId));
		}

		return $newsletterPage;
	}
}