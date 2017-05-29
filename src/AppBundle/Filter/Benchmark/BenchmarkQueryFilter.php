<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle;
use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkQueryFilter extends AuditFilter {
	
	/**
	 *
	 * @var string
	 */
	protected $name = null;
	
	
	public function initRequestValues(Request $request) {	
		$this->name = $this->getRequestString($request, 'name');
	}
	
	public function clearRequestValues() {
		$this->name = null;
	}
	
	public function getRequestValues() {
		$values = array();
	
		$this->setRequestString($values, 'name', $this->name);
		
		return $values;
	}
	
	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return NameFilter
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