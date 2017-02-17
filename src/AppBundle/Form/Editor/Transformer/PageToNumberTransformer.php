<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Page;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class PageToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (page) to a number (id).
	 *
	 * @param  Page|null $page
	 * @return integer
	 */
	public function transform($page)
	{
		if (null === $page) {
			return 0;
		}
		return $page->getId();
	}

	/**
	 * Transforms a number (id) to an object (page).
	 *
	 * @param  string $pageId
	 * @return Page|null
	 * @throws TransformationFailedException if object (page) is not found.
	 */
	public function reverseTransform($pageId)
	{
		if (!$pageId) {
			return;
		}

		$page = $this->em->getRepository(Page::class)->find($pageId);

		if (null === $page) {
			throw new TransformationFailedException(sprintf('An page with id "%s" does not exist!', $pageId));
		}

		return $page;
	}
}