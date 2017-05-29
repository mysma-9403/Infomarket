<?php

namespace AppBundle\Filter\Benchmark;

use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Filter\Admin\Base\AuditFilter;


class BenchmarkMessageFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $products;
	
	/**
	 *
	 * @var array
	 */
	protected $states;
	
	/**
	 *
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var integer
	 */
	protected $readByAuthor = self::ALL_VALUES;
	
	/**
	 *
	 * @var integer
	 */
	protected $contextUser;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->products = $this->getRequestArray($request, 'products');
		$this->states = $this->getRequestArray($request, 'states');
		
		$this->name = $this->getRequestString($request, 'name');
		
		$this->readByAuthor = $this->getRequestBool($request, 'read_by_admin');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->products = array();
		$this->states = array();
		
		$this->name = null;
		
		$this->readByAuthor = self::ALL_VALUES;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'products', $this->products);
		$this->setRequestArray($values, 'states', $this->states);
		
		$this->setRequestString($values, 'name', $this->name);
		
		$this->setRequestBool($values, 'read_by_admin', $this->readByAuthor);
		
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
	 * Set products
	 *
	 * @param array $products
	 *
	 * @return BenchmarkMessageFilter
	 */
	public function setProducts($products)
	{
		$this->products = $products;
	
		return $this;
	}
	
	/**
	 * Get products
	 *
	 * @return array
	 */
	public function getProducts()
	{
		return $this->products;
	}
	
	/**
	 * Set states
	 *
	 * @param array $states
	 *
	 * @return BenchmarkMessageFilter
	 */
	public function setStates($states)
	{
		$this->states = $states;
	
		return $this;
	}
	
	/**
	 * Get states
	 *
	 * @return array
	 */
	public function getStates()
	{
		return $this->states;
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
	
	/**
	 * Set readByAuthor
	 *
	 * @param integer $readByAuthor
	 *
	 * @return SimpleEntityFilter
	 */
	public function setReadByAuthor($readByAuthor)
	{
		$this->readByAuthor = $readByAuthor;
	
		return $this;
	}
	
	/**
	 * Get readByAuthor
	 *
	 * @return integer
	 */
	public function getReadByAuthor()
	{
		return $this->readByAuthor;
	}
}