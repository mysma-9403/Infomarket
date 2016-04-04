<?php

namespace AppBundle\Entity\Filter\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class SimpleEntityFilter extends BaseEntityFilter {
	
	const ALL_VALUES = 0;
	const TRUE_VALUES = 1;
	const FALSE_VALUES = 2;
	
	/**
	 *
	 * @var string
	 */
	public $filterName = 'simple_filter_';
	
	/**
	 * 
	 */
	protected function getFilterName() {
		return $this->filterName;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::initValues()
	 */
	public function initValues(Request $request) {
		//TODO replace selected with entry list - like stages in Song filter
		$this->selected = $request->get($this->getFilterName() . 'selected', array());
		
		$this->name = $request->get($this->getFilterName() . 'name', null);
		
		$this->published = $request->get($this->getFilterName() . 'published', null);
		
		$this->createdAfter = $request->get($this->getFilterName() . 'createdAfter', null);
		$this->createdBefore = $request->get($this->getFilterName() . 'createdBefore', null);
		$this->updatedAfter = $request->get($this->getFilterName() . 'updatedAfter', null);
		$this->updatedBefore = $request->get($this->getFilterName() . 'updatedBefore', null);
		
		$this->initMoreValues($request);
		
		return $this;
	}
	
	/**
	 * 
	 * @param Request $request
	 */
	protected function initMoreValues(Request $request) { }
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::clearQueryValues()
	 */
	public function clearQueryValues() {
		$this->name = null;
	
		$this->published = null;
		
		$this->createdAfter = null;
		$this->createdBefore = null;
		$this->updatedAfter = null;
		$this->updatedBefore = null;
		
		$this->clearMoreQueryValues();
		
		return $this;
	}
	
	/**
	 * 
	 */
	protected function clearMoreQueryValues() { }
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getValues()
	 */
	public function getValues() {
		$values = array();
		
		$values[$this->getFilterName() . 'selected'] = $this->selected;
		
		$values[$this->getFilterName() . 'name'] = $this->name;
		
		$values[$this->getFilterName() . 'published'] = $this->published;
		
		//TODO get filter expressions
		//$values[$this->getFilterName() . 'createdAfter'] = $this->createdAfter;
		//$values[$this->getFilterName() . 'createdBefore'] = $this->createdBefore;
		//$values[$this->getFilterName() . 'updatedAfter'] = $this->updatedAfter;
		//$values[$this->getFilterName() . 'updatedBefore'] = $this->updatedBefore;
		
		return $values;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getExpressions()
	 */
	protected function getWhereExpressions() {
		$expressions = array();
		
		if($this->name != '') {
			$expressions[] = 'e.name like \'%' . $this->name . '%\'';
		}
		
		if($this->published == $this::TRUE_VALUES) {
			$expressions[] = 'e.published = true';
		}
		else if($this->published == $this::FALSE_VALUES) {
			$expressions[] = 'e.published = false';
		}
		
		if($this->createdAfter != null) {
			$expressions[] = 'e.createdAt > ' . $this->createdAfter;
		}
		
		if($this->createdBefore != null) {
			$expressions[] = 'e.createdAt < ' . $this->createdBefore;
		}
		
		if($this->updatedAfter != null) {
			$expressions[] = 'e.updatedAt > ' . $this->updatedAfter;
		}
		
		if($this->updatedBefore != null) {
			$expressions[] = 'e.updatedAt < ' . $this->updatedBefore;
		}
		
		return $expressions;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getOrderByExpression()
	 */
	public function getOrderByExpression() {
		return 'ORDER BY e.name ASC';
	}
	
	/**
	 * @var array
	 */
	protected $selected;
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var integer
	 */
	protected $published;
	
	/**
	 * @var datetime
	 */
	protected $createdAfter;
	
	/**
	 * @var datetime
	 */
	protected $createdBefore;
	
	/**
	 * @var datetime
	 */
	protected $updatedAfter;
	
	/**
	 * @var datetime
	 */
	protected $updatedBefore;
	
	/**
	 * Add id of selected entry
	 *
	 * @param integer $selected
	 *
	 * @return SimpleEntityFilter
	 */
	public function addSelected($selected)
	{
		$this->selected[] = $selected;
	
		return $this;
	}
	
	/**
	 * Get selected ids
	 *
	 * @return array
	 */
	public function getSelected()
	{
		return $this->selected;
	}
	
	/**
	 * Clear selected ids
	 *
	 * @return SimpleEntityFilter
	 */
	public function clearSelected()
	{
		$this->selected = array();
	
		return $this;
	}
	
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
	
	/**
	 * Set published
	 *
	 * @param integer $published
	 *
	 * @return SimpleEntityFilter
	 */
	public function setPublished($published)
	{
		$this->published = $published;
	
		return $this;
	}
	
	/**
	 * Get published
	 *
	 * @return integer
	 */
	public function getPublished()
	{
		return $this->published;
	}
	
	/**
	 * Set createdAfter
	 *
	 * @param datetime $createdAfter
	 *
	 * @return SimpleEntityFilter
	 */
	public function setCreatedAfter($createdAfter)
	{
		$this->createdAfter = $createdAfter;
	
		return $this;
	}
	
	/**
	 * Get createdAfter
	 *
	 * @return datetime
	 */
	public function getCreatedAfter()
	{
		return $this->createdAfter;
	}
	
	/**
	 * Set createdBefore
	 *
	 * @param datetime $createdBefore
	 *
	 * @return SimpleEntityFilter
	 */
	public function setCreatedBefore($createdBefore)
	{
		$this->createdBefore = $createdBefore;
	
		return $this;
	}
	
	/**
	 * Get createdBefore
	 *
	 * @return datetime
	 */
	public function getCreatedBefore()
	{
		return $this->createdBefore;
	}
	
	/**
	 * Set updatedAfter
	 *
	 * @param datetime $updatedAfter
	 *
	 * @return SimpleEntityFilter
	 */
	public function setUpdatedAfter($updatedAfter)
	{
		$this->updatedAfter = $updatedAfter;
	
		return $this;
	}
	
	/**
	 * Get updatedAfter
	 *
	 * @return datetime
	 */
	public function getUpdatedAfter()
	{
		return $this->updatedAfter;
	}
	
	/**
	 * Set updatedBefore
	 *
	 * @param datetime $updatedBefore
	 *
	 * @return SimpleEntityFilter
	 */
	public function setUpdatedBefore($updatedBefore)
	{
		$this->updatedBefore = $updatedBefore;
	
		return $this;
	}
	
	/**
	 * Get updatedBefore
	 *
	 * @return datetime
	 */
	public function getUpdatedBefore()
	{
		return $this->updatedBefore;
	}
}