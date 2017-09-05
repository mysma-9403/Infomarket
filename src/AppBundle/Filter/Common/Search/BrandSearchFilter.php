<?php

namespace AppBundle\Filter\Common\Search;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class BrandSearchFilter extends SearchFilter {

	/**
	 *
	 * @var array
	 */
	protected $brands = null;

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->brands = $this->getRequestArray($request, 'brands');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->brands = null;
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'brands', $this->brands);
		
		return $values;
	}

	public function setBrands($brands) {
		$this->brands = $brands;
		
		return $this;
	}

	public function getBrands() {
		return $this->brands;
	}
}