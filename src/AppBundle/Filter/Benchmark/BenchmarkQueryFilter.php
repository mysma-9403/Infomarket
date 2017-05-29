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
	protected $name;
	
	/**
	 * 
	 * @var integer
	 */
	protected $contextUser;
	
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
	 * Set contextUser
	 *
	 * @param string $contextUser
	 *
	 * @return ContextUserFilter
	 */
	public function setContextUser($contextUser)
	{
		$this->contextUser = $contextUser;
	
		return $this;
	}
	
	/**
	 * Get contextUser
	 *
	 * @return string
	 */
	public function getContextUser()
	{
		return $this->contextUser;
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