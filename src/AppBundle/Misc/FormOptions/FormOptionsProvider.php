<?php

namespace AppBundle\Misc\FormOptions;

use AppBundle\Misc\ItemsProvider\ItemsProvider;
use AppBundle\Utils\ParamUtils;

class FormOptionsProvider {
	
	/**
	 * 
	 * @var array
	 */
	protected $itemsProviders;
	
	public  function __construct(array $itemsProviders) {
		$this->itemsProviders = $itemsProviders;
	}
	
	public function getFormOptions() {
		$options = [];
		
		foreach ($this->itemsProviders as $option => $itemsProvider) {
			/** @var ItemsProvider $itemsProvider */
			$options[ParamUtils::getChoicesName($option)] = $itemsProvider->getItems();
		}
		
		return $options;
	}
}