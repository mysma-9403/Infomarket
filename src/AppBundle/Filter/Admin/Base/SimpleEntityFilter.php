<?php

namespace AppBundle\Filter\Admin\Base;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class SimpleEntityFilter extends SimpleFilter {
	
	/**
	 * @var string
	 */
	protected $name = null;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->name = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);

		return $values;
	}
	
	
	
	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return SimpleEntityFilter
	 */
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}