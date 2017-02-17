<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\ArticleCategory;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ArticleCategoryToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (articleCategory) to a number (id).
	 *
	 * @param  ArticleCategory|null $articleCategory
	 * @return integer
	 */
	public function transform($articleCategory)
	{
		if (null === $articleCategory) {
			return 0;
		}
		return $articleCategory->getId();
	}

	/**
	 * Transforms a number (id) to an object (articleCategory).
	 *
	 * @param  string $articleCategoryId
	 * @return ArticleCategory|null
	 * @throws TransformationFailedException if object (articleCategory) is not found.
	 */
	public function reverseTransform($articleCategoryId)
	{
		if (!$articleCategoryId) {
			return;
		}

		$articleCategory = $this->em->getRepository(ArticleCategory::class)->find($articleCategoryId);

		if (null === $articleCategory) {
			throw new TransformationFailedException(sprintf('An articleCategory with id "%s" does not exist!', $articleCategoryId));
		}

		return $articleCategory;
	}
}