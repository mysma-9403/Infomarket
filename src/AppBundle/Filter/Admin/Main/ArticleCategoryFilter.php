<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\FeaturedEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleCategoryFilter extends FeaturedEntityFilter {

	/**
	 * 
	 * @var string
	 */
	protected $subname = null;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->subname = $this->getRequestValue($request, 'subname');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->subname = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestValue($values, 'subname', $this->subname);
		
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
}