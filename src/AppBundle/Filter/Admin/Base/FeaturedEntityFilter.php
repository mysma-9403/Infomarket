<?php

namespace AppBundle\Filter\Admin\Base;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class FeaturedEntityFilter extends SimpleEntityFilter {
	
	/**
	 * @var integer
	 */
	protected $featured = self::ALL_VALUES;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->featured = $this->getRequestBool($request, 'featured');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->featured = self::ALL_VALUES;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestBool($values, 'featured', $this->featured);

		return $values;
	}
	
	
	
	/**
	 * Set featured
	 *
	 * @param integer $featured
	 *
	 * @return FeaturedEntityFilter
	 */
	public function setFeatured($featured)
	{
		$this->featured = $featured;
	
		return $this;
	}
	
	/**
	 * Get featured
	 *
	 * @return integer
	 */
	public function getFeatured()
	{
		return $this->featured;
	}
}