<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use Symfony\Component\HttpFoundation\Request;

class LinkFilter extends SimpleEntityFilter {
	
	public function __construct() {
		$this->filterName = 'link_filter_';
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$this->featured = $request->get($this->getFilterName() . 'featured', SimpleEntityFilter::ALL_VALUES);
		$this->types = $request->get($this->getFilterName() . 'types', array());
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->featured = SimpleEntityFilter::ALL_VALUES;
		$this->types = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->featured != SimpleEntityFilter::ALL_VALUES) {
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
			$expressions[] = $this->getEqualArrayExpression('e.type', $this->types);
		}
		
		return $expressions;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return ' ORDER BY e.orderNumber ASC, e.name ASC ';
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