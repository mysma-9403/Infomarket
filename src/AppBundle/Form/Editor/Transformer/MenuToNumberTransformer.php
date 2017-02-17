<?php

namespace AppBundle\Form\Editor\Transformer;

use AppBundle\Entity\Menu;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MenuToNumberTransformer implements DataTransformerInterface
{
	private $em;

	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Transforms an object (menu) to a number (id).
	 *
	 * @param  Menu|null $menu
	 * @return integer
	 */
	public function transform($menu)
	{
		if (null === $menu) {
			return 0;
		}
		return $menu->getId();
	}

	/**
	 * Transforms a number (id) to an object (menu).
	 *
	 * @param  string $menuId
	 * @return Menu|null
	 * @throws TransformationFailedException if object (menu) is not found.
	 */
	public function reverseTransform($menuId)
	{
		if (!$menuId) {
			return;
		}

		$menu = $this->em->getRepository(Menu::class)->find($menuId);

		if (null === $menu) {
			throw new TransformationFailedException(sprintf('An menu with id "%s" does not exist!', $menuId));
		}

		return $menu;
	}
}