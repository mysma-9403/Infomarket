<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CategoryToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (category) to a number (id).
	 *
	 * @param  Category|null $category
	 * @return integer
	 */
	public function transform($category)
	{
		if (null === $category) {
			return 0;
		}
		return $category->getId();
	}

	/**
	 * Transforms a number (id) to an object (category).
	 *
	 * @param  string $categoryId
	 * @return Category|null
	 * @throws TransformationFailedException if object (category) is not found.
	 */
	public function reverseTransform($categoryId)
	{
		if (!$categoryId) {
			return;
		}

		$category = $this->em->getRepository(Category::class)->find($categoryId);

		if (null === $category) {
			throw new TransformationFailedException(sprintf('An category with id "%s" does not exist!', $categoryId));
		}

		return $category;
	}
}