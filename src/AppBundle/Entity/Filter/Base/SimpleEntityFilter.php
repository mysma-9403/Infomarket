<?php

namespace AppBundle\Entity\Filter\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class SimpleEntityFilter extends BaseEntityFilter {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct();
		
		$this->filterName = "simple_filter_";
		
		$this->orderBy = 'e.name ASC';
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
			$expressions[] = $this->getStringsExpression('e.name', $this->name);
		}
		
		return $expressions;
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