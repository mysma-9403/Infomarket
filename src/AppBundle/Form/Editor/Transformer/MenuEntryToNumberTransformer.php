<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\MenuEntry;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MenuEntryToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (menuEntry) to a number (id).
	 *
	 * @param  MenuEntry|null $menuEntry
	 * @return integer
	 */
	public function transform($menuEntry)
	{
		if (null === $menuEntry) {
			return 0;
		}
		return $menuEntry->getId();
	}

	/**
	 * Transforms a number (id) to an object (menuEntry).
	 *
	 * @param  string $menuEntryId
	 * @return MenuEntry|null
	 * @throws TransformationFailedException if object (menuEntry) is not found.
	 */
	public function reverseTransform($menuEntryId)
	{
		if (!$menuEntryId) {
			return;
		}

		$menuEntry = $this->em->getRepository(MenuEntry::class)->find($menuEntryId);

		if (null === $menuEntry) {
			throw new TransformationFailedException(sprintf('An menuEntry with id "%s" does not exist!', $menuEntryId));
		}

		return $menuEntry;
	}
}