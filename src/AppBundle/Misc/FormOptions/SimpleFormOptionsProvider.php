<?php

namespace AppBundle\Misc\FormOptions;

use AppBundle\Misc\ItemsProvider\ItemsProvider;

class SimpleFormOptionsProvider {
	
	/**
	 * 
	 * @var array
	 */
	protected $itemsProviders;
	
	public  function __construct(array $itemsProviders) {
		$this->itemsProviders = $itemsProviders;
	}
	
	public function getFormOptions(array $params) {
		$options = [];
		
		foreach ($this->itemsProviders as $option => $itemsProvider) {
			/** @var ItemsProvider $itemsProvider */
			$options[$option] = $itemsProvider->getItems($params);
		}
		
		return $options;
	}
}