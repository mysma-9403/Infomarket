<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Link;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class LinkToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (link) to a number (id).
	 *
	 * @param  Link|null $link
	 * @return integer
	 */
	public function transform($link)
	{
		if (null === $link) {
			return 0;
		}
		return $link->getId();
	}

	/**
	 * Transforms a number (id) to an object (link).
	 *
	 * @param  string $linkId
	 * @return Link|null
	 * @throws TransformationFailedException if object (link) is not found.
	 */
	public function reverseTransform($linkId)
	{
		if (!$linkId) {
			return;
		}

		$link = $this->em->getRepository(Link::class)->find($linkId);

		if (null === $link) {
			throw new TransformationFailedException(sprintf('An link with id "%s" does not exist!', $linkId));
		}

		return $link;
	}
}