<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Branch;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class BranchToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (branch) to a number (id).
	 *
	 * @param  Branch|null $branch
	 * @return integer
	 */
	public function transform($branch)
	{
		if (null === $branch) {
			return 0;
		}
		return $branch->getId();
	}

	/**
	 * Transforms a number (id) to an object (branch).
	 *
	 * @param  string $branchId
	 * @return Branch|null
	 * @throws TransformationFailedException if object (branch) is not found.
	 */
	public function reverseTransform($branchId)
	{
		if (!$branchId) {
			return;
		}

		$branch = $this->em->getRepository(Branch::class)->find($branchId);

		if (null === $branch) {
			throw new TransformationFailedException(sprintf('An branch with id "%s" does not exist!', $branchId));
		}

		return $branch;
	}
}