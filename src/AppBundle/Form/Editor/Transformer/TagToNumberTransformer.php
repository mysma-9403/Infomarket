<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TagToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (tag) to a number (id).
	 *
	 * @param  Tag|null $tag
	 * @return integer
	 */
	public function transform($tag)
	{
		if (null === $tag) {
			return 0;
		}
		return $tag->getId();
	}

	/**
	 * Transforms a number (id) to an object (tag).
	 *
	 * @param  string $tagId
	 * @return Tag|null
	 * @throws TransformationFailedException if object (tag) is not found.
	 */
	public function reverseTransform($tagId)
	{
		if (!$tagId) {
			return;
		}

		$tag = $this->em->getRepository(Tag::class)->find($tagId);

		if (null === $tag) {
			throw new TransformationFailedException(sprintf('An tag with id "%s" does not exist!', $tagId));
		}

		return $tag;
	}
}