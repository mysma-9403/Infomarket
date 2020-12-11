<?php

namespace AppBundle\Misc\ListItemsProvider;

use AppBundle\Misc\ValuesProvider\ValuesProvider;
use AppBundle\Misc\ValueProvider\ValueProvider;

class IdListItemsProvider implements ListItemsProvider {

	const ID = 'id';
	
	/**
	 * 
	 * @var ValuesProvider
	 */
	protected $valuesProvider;
	
	/**
	 *
	 * @var ValueProvider
	 */
	protected $valueProvider;

	public function __construct(ValuesProvider $valuesProvider, ValueProvider $valueProvider) {
		$this->valuesProvider = $valuesProvider;
		$this->valueProvider = $valueProvider;
	}

	public function getListItems($items) {
		$listItems = array();
		
		foreach ($items as $item) {
			$value = $this->valueProvider->getValue($item, self::ID);
			$key = implode(' ', $this->valuesProvider->getValues($item));
			
			$listItems[$key] = $value;
		}
		
		return $listItems;
	}
}