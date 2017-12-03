<?php

namespace AppBundle\Misc\ItemsProvider;

use AppBundle\Misc\ItemsProvider\ItemsProvider;

class ViewParamProvider implements ItemsProvider {

	/**
	 * 
	 * @var string
	 */
	protected $paramName;
	
	public function __construct($paramName) {
		$this->paramName = $paramName;
	}
	
	public function getItems(array $params) {
		$viewParams = $params['viewParams'];
		return key_exists($this->paramName, $viewParams) ? $viewParams[$this->paramName] : null;
	}
}