<?php

namespace AppBundle\Filter\Common\Search;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class BrandCategorySearchFilter extends BrandSearchFilter {

	/**
	 *
	 * @var array
	 */
	protected $categories = null;

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->categories = null;
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}
}