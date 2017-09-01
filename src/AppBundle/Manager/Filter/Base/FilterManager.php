<?php

namespace AppBundle\Manager\Filter\Base;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class FilterManager {
	
	/**
	 * 
	 * @var Filter
	 */
	protected $filter;
	
	//TODO take class argument and use reflection to create filter, 
	// then it will be possible to define services in .yml (see reflection in EntityManager?)
	public function __construct(Filter $filter = null) {
		$this->filter = $filter ? $filter : new Filter();
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param array $contextParams
	 * @return Filter
	 */
	public function createFromRequest(Request $request, array $contextParams) {
		$this->filter->initContextParams($contextParams);
		$this->filter->initRequestValues($request);
		
		return $this->filter;
	}
}