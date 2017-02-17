<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Brand;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class BrandToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (brand) to a number (id).
	 *
	 * @param  Brand|null $brand
	 * @return integer
	 */
	public function transform($brand)
	{
		if (null === $brand) {
			return 0;
		}
		return $brand->getId();
	}

	/**
	 * Transforms a number (id) to an object (brand).
	 *
	 * @param  string $brandId
	 * @return Brand|null
	 * @throws TransformationFailedException if object (brand) is not found.
	 */
	public function reverseTransform($brandId)
	{
		if (!$brandId) {
			return;
		}

		$brand = $this->em->getRepository(Brand::class)->find($brandId);

		if (null === $brand) {
			throw new TransformationFailedException(sprintf('An brand with id "%s" does not exist!', $brandId));
		}

		return $brand;
	}
}