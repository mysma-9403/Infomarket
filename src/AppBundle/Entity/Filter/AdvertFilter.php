<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use AppBundle\Entity\AdvertCategoryAssignment;
use AppBundle\Repository\UserRepository;

class AdvertFilter extends SimpleEntityFilter {
	
	/**
	 * @var CategoryRepository
	 */
	protected $categoryRepository;
	
	/**
	 * 
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(UserRepository $userRepository, CategoryRepository $categoryRepository) {
		parent::__construct($userRepository);
		
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'advert_filter_';
		
		$this->active = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$categories = $request->get($this->getFilterName() . 'categories', array());
		$this->categories = $this->categoryRepository->findBy(array('id' => $categories));
		
		$this->locations = $request->get($this->getFilterName() . 'locations', array());
		
		$dateFrom = $request->get($this->getFilterName() . 'date_from', null);
		$this->dateFrom = $dateFrom ? new \DateTime($dateFrom) : null;
		
		$dateTo = $request->get($this->getFilterName() . 'date_to', null);
		$this->dateTo = $dateTo ? new \DateTime($dateTo) : null;
		
		$this->link = $request->get($this->getFilterName() . 'link', null);
		
		$this->showCount = $request->get($this->getFilterName() . 'show_count', null);
		$this->showLimit = $request->get($this->getFilterName() . 'show_limit', null);
		$this->clickCount = $request->get($this->getFilterName() . 'click_count', null);
		$this->clickLimit = $request->get($this->getFilterName() . 'click_limit', null);
		
		$this->active = $request->get($this->getFilterName() . 'active', $this::ALL_VALUES);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->categories = array();
		$this->locations = array();
		
		$this->dateFrom = null;
		$this->dateTo = null;
		
		$this->link = null;
		
		$this->showCount = null;
		$this->showLimit = null;
		$this->clickCount = null;
		$this->clickLimit = null;
		
		$this->active = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		if($this->locations) {
			$values[$this->getFilterName() . 'locations'] = $this->locations;
		}
		
		$values[$this->getFilterName() . 'date_from'] = $this->dateFrom ? $this->dateFrom->format('d-m-Y H:i') : null;
		$values[$this->getFilterName() . 'date_to'] = $this->dateTo ? $this->dateTo->format('d-m-Y H:i') : null;
		
		$values[$this->getFilterName() . 'link'] = $this->link;
		
		$values[$this->getFilterName() . 'show_count'] = $this->showCount;
		$values[$this->getFilterName() . 'show_limit'] = $this->showLimit;
		$values[$this->getFilterName() . 'click_count'] = $this->clickCount;
		$values[$this->getFilterName() . 'click_limit'] = $this->clickLimit;
		
		if($this->active != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'active'] = $this->active;
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->categories) {
			$expressions[] = $this->getEqualArrayExpression('aca.category', $this->categories);
		}
		
		if($this->locations) {
			$expressions[] = $this->getEqualNumberArrayExpression('e.location', $this->locations);
		}
		
		if($this->dateFrom != null) {
			$expressions[] = 'e.dateFrom = \'' . $this->dateFrom->format('Y-m-d H:i') . '\'';
		}
		
		if($this->dateTo != null) {
			$expressions[] = 'e.dateTo = \'' . $this->dateTo->format('Y-m-d H:i') . '\'';
		}
		
		if($this->link != null) $expressions[] = $this->getStringsExpression('e.link', $this->link);
		
		if($this->showCount != null) $expressions[] = 'e.showCount = ' . $this->showCount;
		if($this->showLimit != null) $expressions[] = 'e.showLimit = ' . $this->showLimit;
		if($this->clickCount != null) $expressions[] = 'e.clickCount = ' . $this->clickCount;
		if($this->clickLimit != null) $expressions[] = 'e.clickLimit = ' . $this->clickLimit;
		
		if($this->active == SimpleEntityFilter::TRUE_VALUES) {
			$date = new \DateTime();
			$expressions[] = '(e.dateFrom IS NULL OR e.dateFrom <= \'' . $date->format('Y-m-d H:i') . '\')';
			$expressions[] = '(e.dateTo IS NULL OR e.dateTo >= \'' . $date->format('Y-m-d H:i') . '\')';
			
			$expressions[] = '(e.showLimit IS NULL OR e.showLimit <= 0 OR e.showCount <= e.showLimit)';
			$expressions[] = '(e.clickLimit IS NULL OR e.clickLimit <= 0 OR e.clickCount <= e.clickLimit)';
		} else if($this->active == SimpleEntityFilter::FALSE_VALUES) {
			$date = new \DateTime();
			
			$expression = 'e.dateFrom > \'' . $date->format('Y-m-d H:i') . '\' OR ';
			$expression .= 'e.dateTo < \'' . $date->format('Y-m-d H:i') . '\' OR ';
				
			$expression .= 'e.showCount <= e.showLimit OR ';
			$expression .= 'e.clickCount <= e.clickLimit';
			
			$expressions[] = $expression;
		}
		
		return $expressions;
	}
	
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
		
		if($this->categories) {
			$expressions[] = AdvertCategoryAssignment::class . ' aca WITH aca.advert = e.id';
		}
		
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	protected $categories;
	
	/**
	 *
	 * @var array
	 */
	protected $locations;
	
	/**
	 * @var datetime
	 */
	protected $dateFrom;
	
	/**
	 * @var datetime
	 */
	protected $dateTo;
	
	/**
	 * @var string
	 */
	protected $link;
	
	/**
	 * @var integer
	 */
	protected $showCount;
	
	/**
	 * @var integer
	 */
	protected $showLimit;
	
	/**
	 * @var integer
	 */
	protected $clickCount;
	
	/**
	 * @var integer
	 */
	protected $clickLimit;
	
	/**
	 * @var boolean
	 */
	protected $active;
	
	/**
	 * Set article categories
	 *
	 * @param array $articleCategories
	 *
	 * @return AdvertFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get article categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set article categories
	 *
	 * @param array $articleCategories
	 *
	 * @return AdvertFilter
	 */
	public function setLocations($locations)
	{
		$this->locations = $locations;
	
		return $this;
	}
	
	/**
	 * Get article categories
	 *
	 * @return array
	 */
	public function getLocations()
	{
		return $this->locations;
	}
	
	/**
	 * Set dateFrom
	 *
	 * @param \DateTime $dateFrom
	 *
	 * @return Advert
	 */
	public function setDateFrom($dateFrom)
	{
		$this->dateFrom = $dateFrom;
	
		return $this;
	}
	
	/**
	 * Get dateFrom
	 *
	 * @return \DateTime
	 */
	public function getDateFrom()
	{
		return $this->dateFrom;
	}
	
	/**
	 * Set dateTo
	 *
	 * @param \DateTime $dateTo
	 *
	 * @return Advert
	 */
	public function setDateTo($dateTo)
	{
		$this->dateTo = $dateTo;
	
		return $this;
	}
	
	/**
	 * Get dateTo
	 *
	 * @return \DateTime
	 */
	public function getDateTo()
	{
		return $this->dateTo;
	}
	
	/**
	 * Set link
	 *
	 * @param string $link
	 *
	 * @return Advert
	 */
	public function setLink($link)
	{
		$this->link = $link;
	
		return $this;
	}
	
	/**
	 * Get link
	 *
	 * @return string
	 */
	public function getLink()
	{
		return $this->link;
	}
	
	/**
	 * Set showCount
	 *
	 * @param integer $showCount
	 *
	 * @return Advert
	 */
	public function setShowCount($showCount)
	{
		$this->showCount = $showCount;
	
		return $this;
	}
	
	/**
	 * Get showCount
	 *
	 * @return integer
	 */
	public function getShowCount()
	{
		return $this->showCount;
	}
	
	/**
	 * Set showLimit
	 *
	 * @param integer $showLimit
	 *
	 * @return Advert
	 */
	public function setShowLimit($showLimit)
	{
		$this->showLimit = $showLimit;
	
		return $this;
	}
	
	/**
	 * Get showLimit
	 *
	 * @return integer
	 */
	public function getShowLimit()
	{
		return $this->showLimit;
	}
	
	/**
	 * Set clickCount
	 *
	 * @param integer $clickCount
	 *
	 * @return Advert
	 */
	public function setClickCount($clickCount)
	{
		$this->clickCount = $clickCount;
	
		return $this;
	}
	
	/**
	 * Get clickCount
	 *
	 * @return integer
	 */
	public function getClickCount()
	{
		return $this->clickCount;
	}
	
	/**
	 * Set clickLimit
	 *
	 * @param integer $clickLimit
	 *
	 * @return Advert
	 */
	public function setClickLimit($clickLimit)
	{
		$this->clickLimit = $clickLimit;
	
		return $this;
	}
	
	/**
	 * Get clickLimit
	 *
	 * @return integer
	 */
	public function getClickLimit()
	{
		return $this->clickLimit;
	}
	
	/**
	 * Set active
	 *
	 * @param boolean $active
	 *
	 * @return SimpleEntityFilter
	 */
	public function setActive($active)
	{
		$this->active = $active;
	
		return $this;
	}
	
	/**
	 * Is active
	 *
	 * @return boolean
	 */
	public function isActive()
	{
		return $this->active;
	}
}