<?php

namespace AppBundle\Entity\Filter\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class SimpleEntityFilter extends BaseEntityFilter {
	
	/**
	 * 
	 */
	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = "simple_filter_";
		
		$this->orderBy = 'e.name ASC';
		
		$this->addNameDecorators = false;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) { 
		$this->name = $request->get($this->getFilterName() . 'name', null);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() { 
		$this->name = null;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
		
		$values[$this->getFilterName() . 'name'] = $this->name;
		
		return $values;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getExpressions()
	 */
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->name) {
			$expressions[] = $this->getStringsExpression('e.name', $this->name, $this->addNameDecorators);
		}
		
		return $expressions;
	}
	
	/**
	 * 
	 * @var bool
	 */
	protected $addNameDecorators;
	
	/**
	 * Set addNameDecorators
	 *
	 * @param bool $addNameDecorators
	 *
	 * @return SimpleEntityFilter
	 */
	public function setAddNameDecorators($addNameDecorators)
	{
		$this->addNameDecorators= $addNameDecorators;
	
		return $this;
	}
	
	/**
	 * Get addNameDecorators
	 *
	 * @return bool
	 */
	public function getAddNameDecorators()
	{
		return $this->addNameDecorators;
	}
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return SimpleEntityFilter
	 */
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}