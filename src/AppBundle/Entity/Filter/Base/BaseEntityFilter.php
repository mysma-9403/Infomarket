<?php

namespace AppBundle\Entity\Filter\Base;

use Symfony\Component\HttpFoundation\Request;

class BaseEntityFilter {
	
	const FALSE_VALUES = 0;
	const TRUE_VALUES = 1;
	const ALL_VALUES = 2;
	
	public function __construct() {
		$this->filterName = 'base_filter_';
		
		$this->orderBy = '';
		$this->limit = 0;
		
		$this->published = $this::ALL_VALUES;
	}
	
	/**
	 * 
	 * @param Request $request
	 */
	public function initValues(Request $request) {
		//TODO replace selected with entry list - like stages in Song filter
		$this->selected = $request->get($this->getFilterName() . 'selected', array());
		
		$this->published = $request->get($this->getFilterName() . 'published', $this::ALL_VALUES);
		
		$publishedAfter = $request->get($this->getFilterName() . 'publishedAfter', null);
		$this->publishedAfter = $publishedAfter ? new \DateTime($publishedAfter) : null;
		
		$publishedBefore = $request->get($this->getFilterName() . 'publishedBefore', null);
		$this->publishedBefore = $publishedBefore ? new \DateTime($publishedBefore) : null;
		
		$updatedAfter = $request->get($this->getFilterName() . 'updatedAfter', null);
		$this->updatedAfter = $updatedAfter ? new \DateTime($updatedAfter) : null;
		
		$updatedBefore = $request->get($this->getFilterName() . 'updatedBefore', null);
		$this->updatedBefore = $updatedBefore ? new \DateTime($updatedBefore) : null;
		
		$createdAfter = $request->get($this->getFilterName() . 'createdAfter', null);
		$this->createdAfter = $createdAfter ? new \DateTime($createdAfter) : null;
		
		$createdBefore = $request->get($this->getFilterName() . 'createdBefore', null);
		$this->createdBefore = $createdBefore ? new \DateTime($createdBefore) : null;
		
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
		
		$this->publishedAfter = null;
		$this->publishedBefore = null;
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
		
		if($this->published !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'published'] = $this->published;
		}
		
		
		$values[$this->getFilterName() . 'publishedAfter'] = $this->publishedAfter ? $this->publishedAfter->format('d-m-Y H:i') : null;
		$values[$this->getFilterName() . 'publishedBefore'] = $this->publishedBefore ? $this->publishedBefore->format('d-m-Y H:i') : null;
		$values[$this->getFilterName() . 'updatedAfter'] = $this->updatedAfter ? $this->updatedAfter->format('d-m-Y H:i') : null;
		$values[$this->getFilterName() . 'updatedBefore'] = $this->updatedBefore ? $this->updatedBefore->format('d-m-Y H:i') : null;
		$values[$this->getFilterName() . 'createdAfter'] = $this->createdAfter ? $this->createdAfter->format('d-m-Y H:i') : null;
		$values[$this->getFilterName() . 'createdBefore'] = $this->createdBefore ? $this->createdBefore->format('d-m-Y H:i') : null;
		
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
		
		if($this->published !== SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.published = ' . $this->published;
		}
		
		if($this->publishedAfter !== null) {
			$expressions[] = 'e.publishedAt > \'' . $this->publishedAfter->format('Y-m-d H:i') . '\'';
		}
		
		if($this->publishedBefore !== null) {
			$expressions[] = 'e.publishedAt < \'' . $this->publishedBefore->format('Y-m-d H:i') . '\'';
		}
		
		if($this->updatedAfter !== null) {
			$expressions[] = 'e.updatedAt > \'' . $this->updatedAfter->format('Y-m-d H:i') . '\'';
		}
		
		if($this->updatedBefore !== null) {
			$expressions[] = 'e.updatedAt < \'' . $this->updatedBefore->format('Y-m-d H:i') . '\'';
		}
		
		if($this->createdAfter !== null) {
			$expressions[] = 'e.createdAt > \'' . $this->createdAfter->format('Y-m-d H:i') . '\'';
		}
		
		if($this->createdBefore !== null) {
			$expressions[] = 'e.createdAt < \'' . $this->createdBefore->format('Y-m-d H:i') . '\'';
		}
		
		return $expressions;
	}
	
	public function getOrderByExpression() {
		if($this->orderBy !== '') {
			return ' ORDER BY ' . $this->orderBy;
		}
		return '';
	}
	
	protected function getStringsExpression($name, $string, $addDecorators = false) {
		$values = explode(',', $string);
		
		$expression = null;
		foreach ($values as $value) {
			if($expression) {
				$expression .= ' OR ' . $this->getStringExpression($name, $value, $addDecorators);
			} else {
				$expression = $this->getStringExpression($name, $value, $addDecorators);
			}
		}
		return $expression;
	}
	
	protected function getStringExpression($name, $string, $addDecorators = false) {
		if($addDecorators) {
			$string = '*' . $string . '*';
		}
		
		$like = ' like ';
		if(substr($string, 0, 2) == '<>') {
			$string = str_replace('<>', '', $string);
			$like = ' not like ';
		}
		
		$string = str_replace('*', '%', $string);
		return $name . $like . '\'' . $string . '\'';
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
	 *
	 * @var string
	 */
	protected $filterName;
	
	/**
	 *
	 * @var string
	 */
	protected $orderBy;
	
	/**
	 *
	 * @var integer
	 */
	protected $limit;
	
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
	protected $publishedAfter;
	
	/**
	 * @var datetime
	 */
	protected $publishedBefore;
	
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
	
	/**
	 *
	 * @return string
	 */
	public function getOrderBy() {
		return $this->orderBy;
	}
	
	/**
	 *
	 * @param string $orderByExpression
	 *
	 * @return SimpleEntityFilter
	 */
	public function setOrderBy($orderBy) {
		$this->orderBy = $orderBy;
	
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
	 * Set publishedAfter
	 *
	 * @param datetime $publishedAfter
	 *
	 * @return SimpleEntityFilter
	 */
	public function setPublishedAfter($publishedAfter)
	{
		$this->publishedAfter = $publishedAfter;
	
		return $this;
	}
	
	/**
	 * Get publishedAfter
	 *
	 * @return datetime
	 */
	public function getPublishedAfter()
	{
		return $this->publishedAfter;
	}
	
	/**
	 * Set publishedBefore
	 *
	 * @param datetime $publishedBefore
	 *
	 * @return SimpleEntityFilter
	 */
	public function setPublishedBefore($publishedBefore)
	{
		$this->publishedBefore = $publishedBefore;
	
		return $this;
	}
	
	/**
	 * Get publishedBefore
	 *
	 * @return datetime
	 */
	public function getPublishedBefore()
	{
		return $this->publishedBefore;
	}
	
	/**
	 * Set createdBefore
	 *
	 * @param datetime $createdBefore
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