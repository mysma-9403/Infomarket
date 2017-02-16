<?php

namespace AppBundle\Filter\Common;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class SearchFilter extends Filter {
	
	/**
	 * @var string
	 */
	protected $string = null;
	
	
	
	public function __construct() {
		$this->filterName = 'search_';
	}
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->string = $this->getRequestString($request, 'string');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->string = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'string', $this->string);

		return $values;
	}
	
	
	
	/**
	 * Set string
	 *
	 * @param string $string
	 *
	 * @return SearchFilter
	 */
	public function setString($string)
	{
		$this->string = $string;
	
		return $this;
	}
	
	/**
	 * Get string
	 *
	 * @return string
	 */
	public function getString()
	{
		return $this->string;
	}
}