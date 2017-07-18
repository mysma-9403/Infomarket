<?php

namespace AppBundle\Factory\Common\Choices\Base;

abstract class TwigChoicesFactory extends \Twig_Extension implements ChoicesFactory {
	
	protected $items = [];
	
	public function getItems() {
		return $this->items;
	}
	
	public function getItemLabel($value) {
		return array_search($value, $this->items);
	}
	
	public function getFunctions() {
		return [$this->getTwigFunctionName() => new \Twig_SimpleFunction($this->getTwigFunctionName(), array($this, 'getItemLabel'))];
	}
	
	abstract protected function getTwigFunctionName();
}