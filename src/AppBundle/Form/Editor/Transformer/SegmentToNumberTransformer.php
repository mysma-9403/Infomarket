<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Segment;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class SegmentToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (segment) to a number (id).
	 *
	 * @param  Segment|null $segment
	 * @return integer
	 */
	public function transform($segment)
	{
		if (null === $segment) {
			return 0;
		}
		return $segment->getId();
	}

	/**
	 * Transforms a number (id) to an object (segment).
	 *
	 * @param  string $segmentId
	 * @return Segment|null
	 * @throws TransformationFailedException if object (segment) is not found.
	 */
	public function reverseTransform($segmentId)
	{
		if (!$segmentId) {
			return;
		}

		$segment = $this->em->getRepository(Segment::class)->find($segmentId);

		if (null === $segment) {
			throw new TransformationFailedException(sprintf('An segment with id "%s" does not exist!', $segmentId));
		}

		return $segment;
	}
}