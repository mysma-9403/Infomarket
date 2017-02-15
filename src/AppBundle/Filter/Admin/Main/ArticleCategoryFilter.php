<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleCategoryFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @var string
	 */
	protected $subname = null;
	
	/**
	 *
	 * @var integer
	 */
	protected $featured = self::ALL_VALUES;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->subname = $this->getRequestValue($request, 'subname');
		$this->featured = $this->getRequestBool($request, 'featured');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->subname = null;
		$this->featured = self::ALL_VALUES;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestValue($values, 'subname', $this->subname);
		$this->setRequestBool($values, 'featured', $this->featured);
		
		return $values;
	}
	
	/**
	 * Set subname
	 *
	 * @param array $subname
	 *
	 * @return ArticleCategoryFilter
	 */
	public function setSubname($subname)
	{
		$this->subname = $subname;
	
		return $this;
	}
	
	/**
	 * Get term subname
	 *
	 * @return array
	 */
	public function getSubname()
	{
		return $this->subname;
	}
	
	/**
	 * Set featured
	 *
	 * @param array $featured
	 *
	 * @return ArticleCategoryFilter
	 */
	public function setFeatured($featured)
	{
		$this->featured = $featured;
	
		return $this;
	}
	
	/**
	 * Get term featured
	 *
	 * @return array
	 */
	public function getFeatured()
	{
		return $this->featured;
	}
}