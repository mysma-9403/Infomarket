<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Magazine;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MagazineToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (magazine) to a number (id).
	 *
	 * @param  Magazine|null $magazine
	 * @return integer
	 */
	public function transform($magazine)
	{
		if (null === $magazine) {
			return 0;
		}
		return $magazine->getId();
	}

	/**
	 * Transforms a number (id) to an object (magazine).
	 *
	 * @param  string $magazineId
	 * @return Magazine|null
	 * @throws TransformationFailedException if object (magazine) is not found.
	 */
	public function reverseTransform($magazineId)
	{
		if (!$magazineId) {
			return;
		}

		$magazine = $this->em->getRepository(Magazine::class)->find($magazineId);

		if (null === $magazine) {
			throw new TransformationFailedException(sprintf('An magazine with id "%s" does not exist!', $magazineId));
		}

		return $magazine;
	}
}