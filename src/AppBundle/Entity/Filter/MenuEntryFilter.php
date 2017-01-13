<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Repository\BranchRepository;
use AppBundle\Repository\LinkRepository;
use AppBundle\Repository\MenuEntryRepository;
use AppBundle\Repository\PageRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Repository\MenuRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Entity\MenuEntryCategoryAssignment;

class MenuEntryFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @param BranchRepository $branchRepository
	 * @param MenuEntryRepository $categoryRepository
	 */
	public function __construct(
			UserRepository $userRepository, 
			MenuEntryRepository $menuEntryRepository,
			MenuRepository $menuRepository,
			PageRepository $pageRepository, 
			LinkRepository $linkRepository,
			BranchRepository $branchRepository,
			CategoryRepository $categoryRepository) {
		
		parent::__construct($userRepository);
		
		$this->menuEntryRepository = $menuEntryRepository;
		$this->menuRepository = $menuRepository;
		$this->pageRepository = $pageRepository;
		$this->linkRepository = $linkRepository;
		$this->branchRepository = $branchRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'menu_entry_filter_';
		
		$this->orderBy = 'e.treePath ASC';
		
		$this->root = $this::ALL_VALUES;
	}
	
	/**
	 * @var MenuEntryRepository 
	 */
	protected $menuEntryRepository;
	
	/**
	 * @var MenuRepository
	 */
	protected $menuRepository;
	
	/**
	 * @var PageRepository
	 */
	protected $pageRepository;
	
	/**
	 * @var LinkRepository
	 */
	protected $linkRepository;
	
	/**
	 * @var BranchRepository
	 */
	protected $branchRepository;
	
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
		
		$parents = $request->get($this->getFilterName() . 'parents', array());
		$this->parents = $this->menuEntryRepository->findBy(array('id' => $parents));
		
		$menus = $request->get($this->getFilterName() . 'menus', array());
		$this->menus = $this->menuRepository->findBy(array('id' => $menus));
		
		$pages = $request->get($this->getFilterName() . 'pages', array());
		$this->pages = $this->pageRepository->findBy(array('id' => $pages));
		
		$links = $request->get($this->getFilterName() . 'links', array());
		$this->links = $this->linkRepository->findBy(array('id' => $links));
		
		$branches = $request->get($this->getFilterName() . 'branches', array());
		$this->branches = $this->branchRepository->findBy(array('id' => $branches));
		
		$categories = $request->get($this->getFilterName() . 'categories', array());
		$this->categories = $this->categoryRepository->findBy(array('id' => $categories));
		
		$this->root = $request->get($this->getFilterName() . 'root', $this::ALL_VALUES);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
		
		$this->parents = array();
		
		$this->menus= array();
		$this->pages= array();
		$this->links = array();
		$this->branches = array();
		$this->categories = array();
		
		$this->root = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
		
		if($this->parents) {
			$values[$this->getFilterName() . 'parents'] = $this->getIdValues($this->parents);
		}
		
		if($this->menus) {
			$values[$this->getFilterName() . 'menus'] = $this->getIdValues($this->menus);
		}
		
		if($this->pages) {
			$values[$this->getFilterName() . 'pages'] = $this->getIdValues($this->pages);
		}
		
		if($this->links) {
			$values[$this->getFilterName() . 'links'] = $this->getIdValues($this->links);
		}
		
		if($this->branches) {
			$values[$this->getFilterName() . 'branches'] = $this->getIdValues($this->branches);
		}
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		if($this->root != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'root'] = $this->root;
		}
	
		return $values;
	}
	
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
	
		if($this->menus) {
			$expressions[] = MenuMenuEntryAssignment::class . ' mmea WITH mmea.menuEntry = e.id';
		}
		
		if($this->branches) {
			$expressions[] = MenuEntryBranchAssignment::class . ' meba WITH meba.menuEntry = e.id';
		}
		
		if($this->categories) {
			$expressions[] = MenuEntryCategoryAssignment::class . ' meca WITH meca.menuEntry = e.id';
		}
	
		return $expressions;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getWhereExpressions()
	 */
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->menus) {
			$expressions[] = $this->getEqualArrayExpression('mmea.menu', $this->menus);
		}
		
		if($this->pages) {
			$expressions[] = $this->getEqualArrayExpression('e.page', $this->pages);
		}
		
		if($this->links) {
			$expressions[] = $this->getEqualArrayExpression('e.link', $this->links);
		}
		
		if($this->branches) {
			$expressions[] = $this->getEqualArrayExpression('meba.branch', $this->branches);
		}
		
		if($this->categories) {
			$expressions[] = $this->getEqualArrayExpression('meca.category', $this->categories);
		}
		
		if($this->root == $this::TRUE_VALUES) {
			$expressions[] = 'e.parent IS NULL';
		} else {
			if($this->root == $this::FALSE_VALUES) {
				$expressions[] = 'e.parent IS NOT NULL';
			}
			if($this->parents) {
				$expressions[] = $this->getEqualArrayExpression('e.parent', $this->parents);
			}
		}
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $parents;
	
	/**
	 *
	 * @var array
	 */
	private $menus;
	
	/**
	 *
	 * @var array
	 */
	private $pages;
	
	/**
	 *
	 * @var array
	 */
	private $links;
	
	/**
	 *
	 * @var array
	 */
	private $branches;
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 *
	 * @var boolean
	 */
	private $root;
	
	/**
	 * Set menu entry parents
	 *
	 * @param array $parents
	 *
	 * @return MenuEntryFilter
	 */
	public function setParents($parents)
	{
		$this->parents = $parents;
	
		return $this;
	}
	
	/**
	 * Get menu entry parents
	 *
	 * @return array
	 */
	public function getParents()
	{
		return $this->parents;
	}
	
	/**
	 * Set menu entry menus
	 *
	 * @param array $menus
	 *
	 * @return MenuEntryFilter
	 */
	public function setMenus($menus)
	{
		$this->menus = $menus;
	
		return $this;
	}
	
	/**
	 * Get menu entry menus
	 *
	 * @return array
	 */
	public function getMenus()
	{
		return $this->menus;
	}
	
	/**
	 * Set menu entry pages
	 *
	 * @param array $pages
	 *
	 * @return MenuEntryFilter
	 */
	public function setPages($pages)
	{
		$this->pages = $pages;
	
		return $this;
	}
	
	/**
	 * Get menu entry pages
	 *
	 * @return array
	 */
	public function getPages()
	{
		return $this->pages;
	}
	
	/**
	 * Set menu entry links
	 *
	 * @param array $links
	 *
	 * @return MenuEntryFilter
	 */
	public function setLinks($links)
	{
		$this->links = $links;
	
		return $this;
	}
	
	/**
	 * Get menu entry links
	 *
	 * @return array
	 */
	public function getLinks()
	{
		return $this->links;
	}
	
	/**
	 * Set menu entry branches
	 *
	 * @param array $branches
	 *
	 * @return MenuEntryFilter
	 */
	public function setBranches($branches)
	{
		$this->branches = $branches;
	
		return $this;
	}
	
	/**
	 * Get menu entry branches
	 *
	 * @return array
	 */
	public function getBranches()
	{
		return $this->branches;
	}
	
	/**
	 * Set menu entry categories
	 *
	 * @param array $categories
	 *
	 * @return MenuEntryFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get menu entry categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set root
	 *
	 * @param boolean $root
	 *
	 * @return SimpleEntityFilter
	 */
	public function setRoot($root)
	{
		$this->root = $root;
	
		return $this;
	}
	
	/**
	 * Get root
	 *
	 * @return boolean
	 */
	public function getRoot()
	{
		return $this->root;
	}
}