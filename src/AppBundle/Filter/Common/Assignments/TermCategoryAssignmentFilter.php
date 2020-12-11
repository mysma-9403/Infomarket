<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class TermCategoryAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $terms = array();

	/**
	 *
	 * @var array
	 */
	protected $categories = array();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->terms = $this->getRequestArray($request, 'terms');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->terms = array();
		$this->categories = array();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'terms', $this->terms);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}

	public function setTerms($terms) {
		$this->terms = $terms;
		
		return $this;
	}

	public function getTerms() {
		return $this->terms;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}
}