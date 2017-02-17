<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Term;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TermToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (term) to a number (id).
	 *
	 * @param  Term|null $term
	 * @return integer
	 */
	public function transform($term)
	{
		if (null === $term) {
			return 0;
		}
		return $term->getId();
	}

	/**
	 * Transforms a number (id) to an object (term).
	 *
	 * @param  string $termId
	 * @return Term|null
	 * @throws TransformationFailedException if object (term) is not found.
	 */
	public function reverseTransform($termId)
	{
		if (!$termId) {
			return;
		}

		$term = $this->em->getRepository(Term::class)->find($termId);

		if (null === $term) {
			throw new TransformationFailedException(sprintf('An term with id "%s" does not exist!', $termId));
		}

		return $term;
	}
}