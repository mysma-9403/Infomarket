<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class UserFilter extends BaseFilter {

	/**
	 *
	 * @var string
	 */
	protected $username;

	/**
	 *
	 * @var string
	 */
	protected $forename;

	/**
	 *
	 * @var string
	 */
	protected $surname;

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->username = $this->getRequestString($request, 'username');
		$this->forename = $this->getRequestString($request, 'forename');
		$this->surname = $this->getRequestString($request, 'surname');
	}

	public function clearRequestValues() {
		$this->username = null;
		$this->forename = null;
		$this->surname = null;
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'username', $this->username);
		$this->setRequestString($values, 'forename', $this->forename);
		$this->setRequestString($values, 'surname', $this->surname);
		
		return $values;
	}

	public function setUsername($username) {
		$this->username = $username;
		
		return $this;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setForename($forename) {
		$this->forename = $forename;
		
		return $this;
	}

	public function getForename() {
		return $this->forename;
	}

	public function setSurname($surname) {
		$this->surname = $surname;
		
		return $this;
	}

	public function getSurname() {
		return $this->surname;
	}
}