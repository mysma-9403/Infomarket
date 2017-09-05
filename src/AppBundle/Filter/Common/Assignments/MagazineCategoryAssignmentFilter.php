<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class MagazineCategoryAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $magazines = array ();

	/**
	 *
	 * @var array
	 */
	protected $categories = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->magazines = $this->getRequestArray($request, 'magazines');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->magazines = array ();
		$this->categories = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'magazines', $this->magazines);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}

	public function setMagazines($magazines) {
		$this->magazines = $magazines;
		
		return $this;
	}

	public function getMagazines() {
		return $this->magazines;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}
}