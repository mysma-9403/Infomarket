<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;


class BenchmarkEnumFilter extends AuditFilter {
	
	/**
	 *
	 * @var string
	 */
	protected $name;
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->fieldName = null;
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
	 * @return BenchmarkEnumFilter
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