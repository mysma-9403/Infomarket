<?php

namespace AppBundle\Entity\Filter\Base;

use Symfony\Component\HttpFoundation\Request;

class BaseEntityFilter {
	
	const ALL_VALUES = 0;
	const TRUE_VALUES = 1;
	const FALSE_VALUES = 2;
	
	public function __construct() {
		$this->filterName = 'base_filter_';
	}
	
	/**
	 * 
	 * @param Request $request
	 */
	public function initValues(Request $request) {
		//TODO replace selected with entry list - like stages in Song filter
		$this->selected = $request->get($this->getFilterName() . 'selected', array());
		
		$this->published = $request->get($this->getFilterName() . 'published', $this::ALL_VALUES);
		
		$this->createdAfter = $request->get($this->getFilterName() . 'createdAfter', null);
		$this->createdBefore = $request->get($this->getFilterName() . 'createdBefore', null);
		$this->updatedAfter = $request->get($this->getFilterName() . 'updatedAfter', null);
		$this->updatedBefore = $request->get($this->getFilterName() . 'updatedBefore', null);
		
		$this->initMoreValues($request);
	}
	
	/**
	 *
	 * @param Request $request
	 */
	protected function initMoreValues(Request $request) { }
	
	/**
	 * 
	 */
	public function clearQueryValues() {
		$this->published = $this::ALL_VALUES;
		
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
		
		$values[$this->getFilterName() . 'published'] = $this->published;
		
		//TODO get filter expressions
		//$values[$this->getFilterName() . 'createdAfter'] = $this->createdAfter;
		//$values[$this->getFilterName() . 'createdBefore'] = $this->createdBefore;
		//$values[$this->getFilterName() . 'updatedAfter'] = $this->updatedAfter;
		//$values[$this->getFilterName() . 'updatedBefore'] = $this->updatedBefore;
		
		return $values;
	}
	
	/**
	 * Helper function which converts entry list into id list
	 * useful in request handling.
	 *
	 * @param array $entries
	 * @return array
	 */
	protected function getIdValues($entries) {
		$result = array();
		if($entries) {
			foreach ($entries as $entry) {
				$result[] = $entry->getId();
			}
		}
		return $result;
	}
	
	/**
	 * @return string
	 */
	public function getJoinExpression() {
		$expression = '';
		
		$expressions = $this->getJoinExpressions();
		
		$size = count($expressions);
		for($i = 0; $i < $size; $i++) {
			$expression .= ' JOIN ' . $expressions[$i];
		}
		
		return $expression;
	}
	
	/**
	 * @return array
	 */
	protected function getJoinExpressions() { }
	
	//TODO check if simple findBy can replace this
	/**
	 * 
	 * @return string
	 */
	public function getWhereExpression() {
		$expressions = $this->getWhereExpressions();
		
		$size = count($expressions);
		if($size > 0) {
			$expression = ' WHERE ' . $expressions[0];
			
			for($i = 1; $i < $size; $i++) {
				$expression .= ' AND ' . $expressions[$i];
			}
			
			return $expression;
		}
		
		return '';
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getExpressions()
	 */
	protected function getWhereExpressions() {
		$expressions = array();
		
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
	 * @param unknown $name
	 * @param unknown $entries
	 * @return NULL|string
	 */
	protected function getEqualArrayExpression($name, $entries) {
		$size = count($entries);
		if($size == 0) return null;
	
		if($size == 1) {
			$expression = $name .' = ' . $entries[0]->getId();
		}
		else {
			$expression = $name .' in (' . $entries[0]->getId();
			for ($i = 1; $i < $size; $i++) {
				$expression .= ', ' . $entries[$i]->getId();
			}
			$expression .= ')';
		}
		return $expression;
	}
	
	/**
	 *
	 * @param unknown $name
	 * @param unknown $entries
	 * @return NULL|string
	 */
	protected function getEqualNumberArrayExpression($name, $entries) {
		$size = count($entries);
		if($size == 0) return null;
	
		if($size == 1) {
			$expression = $name .' = ' . $entries[0];
		}
		else {
			$expression = $name .' in (' . $entries[0];
			for ($i = 1; $i < $size; $i++) {
				$expression .= ', ' . $entries[$i];
			}
			$expression .= ')';
		}
		return $expression;
	}
		
	/**
	 * return string
	 */
	public function getOrderByExpression() {
		return '';
	}
	
	
	/**
	 *
	 * @var string
	 */
	protected $filterName;
	
	/**
	 *
	 * @var integer
	 */
	protected $limit = 0;
	
	/**
	 * @var array
	 */
	protected $selected;
	
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
	 *
	 * @return string
	 */
	public function getFilterName() {
		return $this->filterName;
	}
	
	/**
	 *
	 * @param string $filterName
	 *
	 * @return SimpleEntityFilter
	 */
	public function setFilterName($filterName) {
		$this->filterName = $filterName;
	
		return $this;
	}
	
	public function getLimit() {
		return $this->limit;
	}
	
	public function setLimit($limit) {
		$this->limit = $limit;
		
		return $this;
	}
	
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