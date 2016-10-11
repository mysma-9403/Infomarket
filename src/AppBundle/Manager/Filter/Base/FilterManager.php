<?php

namespace AppBundle\Manager\Filter\Base;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;

abstract class FilterManager {
	
	/**
	 * 
	 * @param Request $request
	 * 
	 * @return BaseEntityFilter
	 */
	public function createFromRequest(Request $request, array $params) {
		$filter = $this->create();
		
		$filter->initValues($request);
		
		return $filter;
	}
	
	/**
	 * 
	 * @param BaseEntityFilter $filter
	 */
	public function adaptToView(BaseEntityFilter $filter, array $params) { 
		return $filter;
	}
	
	protected abstract function create();
}