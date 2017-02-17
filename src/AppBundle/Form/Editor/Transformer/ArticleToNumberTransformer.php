<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ArticleToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (article) to a number (id).
	 *
	 * @param  Article|null $article
	 * @return integer
	 */
	public function transform($article)
	{
		if (null === $article) {
			return 0;
		}
		return $article->getId();
	}

	/**
	 * Transforms a number (id) to an object (article).
	 *
	 * @param  string $articleId
	 * @return Article|null
	 * @throws TransformationFailedException if object (article) is not found.
	 */
	public function reverseTransform($articleId)
	{
		if (!$articleId) {
			return;
		}

		$article = $this->em->getRepository(Article::class)->find($articleId);

		if (null === $article) {
			throw new TransformationFailedException(sprintf('An article with id "%s" does not exist!', $articleId));
		}

		return $article;
	}
}