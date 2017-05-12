<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;


class BenchmarkMessageFilter extends SimpleEntityFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $products;
	
	/**
	 *
	 * @var array
	 */
	protected $authors;
	
	/**
	 *
	 * @var array
	 */
	protected $states;
	
	/**
	 * @var integer
	 */
	protected $readByAdmin = self::ALL_VALUES;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->products = $this->getRequestArray($request, 'products');
		$this->authors = $this->getRequestArray($request, 'authors');
		$this->states = $this->getRequestArray($request, 'states');
		
		$this->readByAdmin = $this->getRequestBool($request, 'read_by_admin');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->products = array();
		$this->authors = array();
		$this->states = array();
		
		$this->readByAdmin = self::ALL_VALUES;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'products', $this->products);
		$this->setRequestArray($values, 'authors', $this->authors);
		$this->setRequestArray($values, 'states', $this->states);
		
		$this->setRequestBool($values, 'read_by_admin', $this->readByAdmin);
		
		return $values;
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
	 * Set authors
	 *
	 * @param array $authors
	 *
	 * @return BenchmarkMessageFilter
	 */
	public function setAuthors($authors)
	{
		$this->authors = $authors;
	
		return $this;
	}
	
	/**
	 * Get authors
	 *
	 * @return array
	 */
	public function getAuthors()
	{
		return $this->authors;
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
	 * Set readByAdmin
	 *
	 * @param integer $readByAdmin
	 *
	 * @return SimpleEntityFilter
	 */
	public function setReadByAdmin($readByAdmin)
	{
		$this->readByAdmin = $readByAdmin;
	
		return $this;
	}
	
	/**
	 * Get readByAdmin
	 *
	 * @return integer
	 */
	public function getReadByAdmin()
	{
		return $this->readByAdmin;
	}
}