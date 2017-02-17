<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ProductToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (product) to a number (id).
	 *
	 * @param  Product|null $product
	 * @return integer
	 */
	public function transform($product)
	{
		if (null === $product) {
			return 0;
		}
		return $product->getId();
	}

	/**
	 * Transforms a number (id) to an object (product).
	 *
	 * @param  string $productId
	 * @return Product|null
	 * @throws TransformationFailedException if object (product) is not found.
	 */
	public function reverseTransform($productId)
	{
		if (!$productId) {
			return;
		}

		$product = $this->em->getRepository(Product::class)->find($productId);

		if (null === $product) {
			throw new TransformationFailedException(sprintf('An product with id "%s" does not exist!', $productId));
		}

		return $product;
	}
}