<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class UserFilter extends SimpleEntityFilter {

	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = 'user_filter_';
		
		$this->orderBy = "e.username ASC";
				
		$this->clearMoreQueryValues();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		$this->username = $request->get($this->getFilterName() . 'username', null);
		$this->forename = $request->get($this->getFilterName() . 'forename', null);
		$this->surname = $request->get($this->getFilterName() . 'surname', null);
		$this->username = $request->get($this->getFilterName() . 'username', null);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() { 
		$this->username = null;
		$this->forename = null;
		$this->surname = null;
		$this->email = null;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
		
		$values[$this->getFilterName() . 'username'] = $this->username;
		$values[$this->getFilterName() . 'forename'] = $this->forename;
		$values[$this->getFilterName() . 'surname'] = $this->surname;
		$values[$this->getFilterName() . 'email'] = $this->email;
		
		return $values;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getExpressions()
	 */
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->username) {
			$expressions[] = $this->getStringsExpression('e.username', $this->username, $this->addNameDecorators);
		}
		
		if($this->forename) {
			$expressions[] = $this->getStringsExpression('e.forename', $this->forename, $this->addNameDecorators);
		}
		
		if($this->surname) {
			$expressions[] = $this->getStringsExpression('e.surname', $this->surname, $this->addNameDecorators);
		}
		
		if($this->email) {
			$expressions[] = $this->getStringsExpression('e.email', $this->email, $this->addNameDecorators);
		}
		
		return $expressions;
	}
	
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
	
	/**
	 * @var string
	 */
	protected $email;
	
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
	
	/**
	 * Set email
	 *
	 * @param string $email
	 *
	 * @return SimpleEntityFilter
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	
		return $this;
	}
	
	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}
}