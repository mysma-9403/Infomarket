<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class LinkFilter extends SimpleEntityFilter {
	
	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = 'link_filter_';
		
		$this->featured = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
		
		$this->types = $request->get($this->getFilterName() . 'types', array());
		
		$this->featured = $request->get($this->getFilterName() . 'featured', $this::ALL_VALUES);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->types = array();
		
		$this->featured = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->featured !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'featured'] = $this->featured;
		}
		
		if($this->types) {
			$values[$this->getFilterName() . 'types'] = $this->types;
		}
	
		return $values;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getWhereExpressions()
	 */
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->featured) {
			$expressions[] = 'e.featured = ' . $this->featured;
		}
		
		if($this->types) {
			$expressions[] = $this->getEqualNumberArrayExpression('e.type', $this->types);
		}
		
		return $expressions;
	}
	
	/**
	 * @var integer
	 */
	private $featured;
	
	/**
	 * @var array
	 */
	private $types;
	
	/**
	 * Set featured
	 *
	 * @param integer $featured
	 *
	 * @return SimpleEntityFilter
	 */
	public function setFeatured($featured)
	{
		$this->featured = $featured;
	
		return $this;
	}
	
	/**
	 * Get featured
	 *
	 * @return integer
	 */
	public function getFeatured()
	{
		return $this->featured;
	}
	
	/**
	 * Set types
	 *
	 * @param array $types
	 *
	 * @return SimpleEntityFilter
	 */
	public function setTypes($types)
	{
		$this->types = $types;
	
		return $this;
	}
	
	/**
	 * Get types
	 *
	 * @return array
	 */
	public function getTypes()
	{
		return $this->types;
	}
}