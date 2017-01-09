<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class PageFilter extends SimpleEntityFilter {
	
	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterSubname = 'page_filter_';
		
		$this->orderBy = 'e.subname ASC, e.subname ASC';
		
		$this->addSubnameDecorators = false;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$this->subname = $request->get($this->getFilterSubname() . 'subname', null);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->subname = null;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		$values[$this->getFilterSubname() . 'subname'] = $this->subname;
	
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->subname) {
			$expressions[] = $this->getStringsExpression('e.subname', $this->subname, $this->addSubnameDecorators);
		}
		
		return $expressions;
	}
	
	/**
	 * 
	 * @var bool
	 */
	protected $addSubnameDecorators;
	
	/**
	 * Set addSubnameDecorators
	 *
	 * @param bool $addSubnameDecorators
	 *
	 * @return SimpleEntityFilter
	 */
	public function setAddSubnameDecorators($addSubnameDecorators)
	{
		$this->addSubnameDecorators= $addSubnameDecorators;
	
		return $this;
	}
	
	/**
	 * Get addSubnameDecorators
	 *
	 * @return bool
	 */
	public function getAddSubnameDecorators()
	{
		return $this->addSubnameDecorators;
	}
	
	/**
	 * @var string
	 */
	protected $subname;
	
	/**
	 * Set subname
	 *
	 * @param string $subname
	 *
	 * @return SimpleEntityFilter
	 */
	public function setSubname($subname)
	{
		$this->subname = $subname;
	
		return $this;
	}
	
	/**
	 * Get subname
	 *
	 * @return string
	 */
	public function getSubname()
	{
		return $this->subname;
	}
}