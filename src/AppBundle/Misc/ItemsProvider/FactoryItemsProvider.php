<?php

namespace AppBundle\Misc\ItemsProvider;

use AppBundle\Factory\Common\Choices\Base\ChoicesFactory;

class FactoryItemsProvider implements ItemsProvider {

	/**
	 *
	 * @var ChoicesFactory
	 */
	protected $factory;

	public function __construct(ChoicesFactory $factory) {
		$this->factory = $factory;
	}

	public function getItems(array $params) {
		return $this->factory->getItems();
	}
}