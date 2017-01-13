<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Category;
use AppBundle\Entity\MenuEntry;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\MenuEntryRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryCategoryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param UserRepository $userRepository
	 * @param MenuEntryRepository $menuEntryRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(
			UserRepository $userRepository, 
			MenuEntryRepository $menuEntryRepository, 
			CategoryRepository $categoryRepository) {
		
		parent::__construct($userRepository);
		
		$this->menuEntryRepository = $menuEntryRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'menuEntry_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, c.subname ASC, me.name ASC';
	}
	
	/**
	 * @var MenuEntryCategoryAssignmentCategoryRepository
	 */
	protected $menuEntryRepository;
	
	/**
	 * @var CategoryRepository
	 */
	protected $categoryRepository;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$menuEntries = $request->get($this->getFilterName() . 'menuEntries', array());
		$this->menuEntries = $this->menuEntryRepository->findBy(array('id' => $menuEntries));
		
		$categories = $request->get($this->getFilterName() . 'categories', array());
		$this->categories = $this->categoryRepository->findBy(array('id' => $categories));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->menuEntries = array();
		$this->categories = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->menuEntries) {
			$values[$this->getFilterName() . 'menuEntries'] = $this->getIdValues($this->menuEntries);
		}
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->menuEntries) {
			$expressions[] = $this->getEqualArrayExpression('e.menuEntry', $this->menuEntries);
		}
		
		if($this->categories) {
			$expressions[] = $this->getEqualArrayExpression('e.category', $this->categories);
		}
		
		return $expressions;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getJoinExpressions()
	 */
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
		
		$expressions[] = MenuEntry::class . ' me WITH e.menuEntry = me.id';
		$expressions[] = Category::class . ' c WITH e.category = c.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $menuEntries;
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 * Set menuEntries
	 *
	 * @param array $menuEntries
	 *
	 * @return MenuEntryCategoryAssignmentFilter
	 */
	public function setMenuEntries($menuEntries)
	{
		$this->menuEntries = $menuEntries;
	
		return $this;
	}
	
	/**
	 * Get menuEntries
	 *
	 * @return array
	 */
	public function getMenuEntries()
	{
		return $this->menuEntries;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return MenuEntryCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get menuEntry categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}