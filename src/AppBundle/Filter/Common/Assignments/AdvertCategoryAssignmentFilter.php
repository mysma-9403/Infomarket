<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class AdvertCategoryAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $adverts = array ();

	/**
	 *
	 * @var array
	 */
	protected $categories = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->adverts = $this->getRequestArray($request, 'adverts');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->adverts = array ();
		$this->categories = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'adverts', $this->adverts);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}

	public function setAdverts($adverts) {
		$this->adverts = $adverts;
		
		return $this;
	}

	public function getAdverts() {
		return $this->adverts;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}
}