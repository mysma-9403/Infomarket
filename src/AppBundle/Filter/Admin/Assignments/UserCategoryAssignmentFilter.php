<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\User;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class UserCategoryAssignmentFilter extends AuditFilter {
	
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
	
	/**
	 * Set users
	 *
	 * @param array $users
	 *
	 * @return UserCategoryAssignmentFilter
	 */
	public function setUsers($users)
	{
		$this->users = $users;
	
		return $this;
	}
	
	/**
	 * Get users
	 *
	 * @return array
	 */
	public function getUsers()
	{
		return $this->users;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return UserCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get user categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}