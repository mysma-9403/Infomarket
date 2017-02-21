<?php

namespace AppBundle\Filter\Benchmark\Washer;

use AppBundle;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Filter\Benchmark\ProductFilter;

class WasherCentrifugeFilter extends ProductFilter {
	
	/**
	 * 
	 * @var integer
	 */
	protected $minWasherPower;
	
	/**
	 *
	 * @var integer
	 */
	protected $maxWasherPower;
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->minWasherPower = $this->getRequestValue($request, 'min_price');
		$this->maxWasherPower = $this->getRequestValue($request, 'max_price');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->minWasherPower = null;
		$this->maxWasherPower = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestValue($values, 'min_price', $this->minWasherPower);
		$this->setRequestValue($values, 'max_price', $this->maxWasherPower);
		
		return $values;
	}
	
	/**
	 * Set minWasherPower
	 *
	 * @param integer $minWasherPower
	 *
	 * @return WasherFilter
	 */
	public function setMinWasherPower($minWasherPower)
	{
		$this->minWasherPower = $minWasherPower;
	
		return $this;
	}
	
	/**
	 * Get term minWasherPower
	 *
	 * @return integer
	 */
	public function getMinWasherPower()
	{
		return $this->minWasherPower;
	}
	
	/**
	 * Set maxWasherPower
	 *
	 * @param integer $maxWasherPower
	 *
	 * @return WasherFilter
	 */
	public function setMaxWasherPower($maxWasherPower)
	{
		$this->maxWasherPower = $maxWasherPower;
	
		return $this;
	}
	
	/**
	 * Get term maxWasherPower
	 *
	 * @return integer
	 */
	public function getMaxWasherPower()
	{
		return $this->maxWasherPower;
	}
}