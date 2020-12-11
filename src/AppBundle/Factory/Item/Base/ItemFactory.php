<?php

namespace AppBundle\Factory\Item\Base;

use Symfony\Component\HttpFoundation\Request;

class ItemFactory {

	/**
	 *
	 * @var class (e.g. Product::class)
	 */
	protected $type;

	/**
	 *
	 * @param class $type
	 *        	(e.g. Product::class)
	 */
	public function __construct($type) {
		$this->type = $type;
	}

	/**
	 * Create new item from request parameters.
	 *
	 * @param Request $request        	
	 *
	 * @return Simple
	 */
	public function createFromRequest(Request $request) {
		return $this->create();
	}

	/**
	 * Create new item from template parameters.
	 *
	 * @param Simple $template        	
	 *
	 * @return Simple
	 */
	public function createFromTemplate($template) {
		return $this->create();
	}

	/**
	 * Create new item.
	 *
	 * @return Simple
	 */
	public function create() {
		$refClass = new \ReflectionClass($this->type);
		return $refClass->newInstanceArgs();
	}
}