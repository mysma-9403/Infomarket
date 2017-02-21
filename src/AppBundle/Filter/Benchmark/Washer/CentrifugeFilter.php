<?php

namespace AppBundle\Filter\Benchmark\Washer;

use AppBundle;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Filter\Benchmark\ProductFilter;

class CentrifugeFilter extends ProductFilter {
	
	/**
	 * 
	 * @var integer
	 */
	protected $minPower;
	
	/**
	 *
	 * @var integer
	 */
	protected $maxPower;
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->minPower = $this->getRequestValue($request, 'min_price');
		$this->maxPower = $this->getRequestValue($request, 'max_price');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->minPower = null;
		$this->maxPower = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestValue($values, 'min_price', $this->minPower);
		$this->setRequestValue($values, 'max_price', $this->maxPower);
		
		return $values;
	}
	
	/**
	 * Set minPower
	 *
	 * @param integer $minPower
	 *
	 * @return WasherFilter
	 */
	public function setMinPower($minPower)
	{
		$this->minPower = $minPower;
	
		return $this;
	}
	
	/**
	 * Get term minPower
	 *
	 * @return integer
	 */
	public function getMinPower()
	{
		return $this->minPower;
	}
	
	/**
	 * Set maxPower
	 *
	 * @param integer $maxPower
	 *
	 * @return WasherFilter
	 */
	public function setMaxPower($maxPower)
	{
		$this->maxPower = $maxPower;
	
		return $this;
	}
	
	/**
	 * Get term maxPower
	 *
	 * @return integer
	 */
	public function getMaxPower()
	{
		return $this->maxPower;
	}
}