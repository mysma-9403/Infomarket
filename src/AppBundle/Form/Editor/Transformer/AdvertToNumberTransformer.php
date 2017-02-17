<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Advert;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class AdvertToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (advert) to a number (id).
	 *
	 * @param  Advert|null $advert
	 * @return integer
	 */
	public function transform($advert)
	{
		if (null === $advert) {
			return 0;
		}
		return $advert->getId();
	}

	/**
	 * Transforms a number (id) to an object (advert).
	 *
	 * @param  string $advertId
	 * @return Advert|null
	 * @throws TransformationFailedException if object (advert) is not found.
	 */
	public function reverseTransform($advertId)
	{
		if (!$advertId) {
			return;
		}

		$advert = $this->em->getRepository(Advert::class)->find($advertId);

		if (null === $advert) {
			throw new TransformationFailedException(sprintf('An advert with id "%s" does not exist!', $advertId));
		}

		return $advert;
	}
}