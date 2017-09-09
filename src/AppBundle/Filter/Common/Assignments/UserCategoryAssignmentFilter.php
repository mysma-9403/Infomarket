<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class UserCategoryAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $users = array();

	/**
	 *
	 * @var array
	 */
	protected $categories = array();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->users = $this->getRequestArray($request, 'users');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->users = array();
		$this->categories = array();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'users', $this->users);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}

	public function setUsers($users) {
		$this->users = $users;
		
		return $this;
	}

	public function getUsers() {
		return $this->users;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}
}