<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle\Filter\Admin\Base\AdminFilter;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class UserFilter extends AdminFilter {

	/**
	 * @var string
	 */
	protected $username;
	
	/**
	 * @var string
	 */
	protected $forename;
	
	/**
	 * @var string
	 */
	protected $surname;
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->username = $this->getRequestValue($request, 'username');
		$this->forename = $this->getRequestValue($request, 'forename');
		$this->surname = $this->getRequestValue($request, 'surname');
	}
	
	public function clearRequestValues() { 
		$this->username = null;
		$this->forename = null;
		$this->surname = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestValue($values, 'username', $this->username);
		$this->setRequestValue($values, 'forename', $this->forename);
		$this->setRequestValue($values, 'surname', $this->surname);
		
		return $values;
	}
	
	/**
	 * Set username
	 *
	 * @param string $username
	 *
	 * @return SimpleEntityFilter
	 */
	public function setUsername($username)
	{
		$this->username = $username;
	
		return $this;
	}
	
	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}
	
	/**
	 * Set forename
	 *
	 * @param string $forename
	 *
	 * @return SimpleEntityFilter
	 */
	public function setForename($forename)
	{
		$this->forename = $forename;
	
		return $this;
	}
	
	/**
	 * Get forename
	 *
	 * @return string
	 */
	public function getForename()
	{
		return $this->forename;
	}
	
	/**
	 * Set surname
	 *
	 * @param string $surname
	 *
	 * @return SimpleEntityFilter
	 */
	public function setSurname($surname)
	{
		$this->surname = $surname;
	
		return $this;
	}
	
	/**
	 * Get surname
	 *
	 * @return string
	 */
	public function getSurname()
	{
		return $this->surname;
	}
}