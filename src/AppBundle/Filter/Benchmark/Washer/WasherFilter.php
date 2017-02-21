<?php

namespace AppBundle\Filter\Benchmark\Washer;

use AppBundle;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Filter\Benchmark\ProductFilter;

class WasherFilter extends ProductFilter {
	
	/**
	 * 
	 * @var integer
	 */
	protected $minCapacity;
	
	/**
	 *
	 * @var integer
	 */
	protected $maxCapacity;
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->minCapacity = $this->getRequestValue($request, 'min_price');
		$this->maxCapacity = $this->getRequestValue($request, 'max_price');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->minCapacity = null;
		$this->maxCapacity = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestValue($values, 'min_price', $this->minCapacity);
		$this->setRequestValue($values, 'max_price', $this->maxCapacity);
		
		return $values;
	}
	
	/**
	 * Set minCapacity
	 *
	 * @param integer $minCapacity
	 *
	 * @return WasherFilter
	 */
	public function setMinCapacity($minCapacity)
	{
		$this->minCapacity = $minCapacity;
	
		return $this;
	}
	
	/**
	 * Get term minCapacity
	 *
	 * @return integer
	 */
	public function getMinCapacity()
	{
		return $this->minCapacity;
	}
	
	/**
	 * Set maxCapacity
	 *
	 * @param integer $maxCapacity
	 *
	 * @return WasherFilter
	 */
	public function setMaxCapacity($maxCapacity)
	{
		$this->maxCapacity = $maxCapacity;
	
		return $this;
	}
	
	/**
	 * Get term maxCapacity
	 *
	 * @return integer
	 */
	public function getMaxCapacity()
	{
		return $this->maxCapacity;
	}
}