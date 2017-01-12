<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Entity\Category;
use AppBundle\Repository\MagazineRepository;
use AppBundle\Repository\BranchRepository;
use AppBundle\Entity\Branch;
use AppBundle\Entity\MagazineCategoryAssignment;
use AppBundle\Entity\MagazineBranchAssignment;

class MagazineFilter extends SimpleEntityFilter {

	/**
	 * @var MagazineRepository
	 */
	protected $magazineRepository;
	
	/**
	 * @var CategoryRepository
	 */
	protected $categoryRepository;
	
	/**
	 * @var BranchRepository
	 */
	protected $branchRepository;
	
	public function __construct(
			UserRepository $userRepository, 
			MagazineRepository $magazineRepository, 
			CategoryRepository $categoryRepository, 
			BranchRepository $branchRepository) {
		parent::__construct($userRepository);
		
		$this->magazineRepository = $magazineRepository;
		$this->categoryRepository = $categoryRepository;
		$this->branchRepository = $branchRepository;
		
		$this->filterName = 'magazine_filter_';
		
		$this->orderBy = 'e.date DESC, e.orderNumber ASC, e.name ASC';
		
		$this->featured = $this::ALL_VALUES;
		$this->root = $this::ALL_VALUES;
		$this->main = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
		
		$parents = $request->get($this->getFilterName() . 'parents', array());
		$this->parents = $this->magazineRepository->findBy(array('id' => $parents));
		
		$categories = $request->get($this->getFilterName() . 'categories', array());
		$this->categories = $this->categoryRepository->findBy(array('id' => $categories));
		
		$branches = $request->get($this->getFilterName() . 'branches', array());
		$this->branches = $this->branchRepository->findBy(array('id' => $branches));
		
		$this->featured = $request->get($this->getFilterName() . 'featured', $this::ALL_VALUES);
		$this->root = $request->get($this->getFilterName() . 'root', $this::ALL_VALUES);
		$this->main = $request->get($this->getFilterName() . 'main', $this::ALL_VALUES);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
		
		$this->parents = array();
		$this->categories = array();
		$this->branches = array();
		
		$this->featured = $this::ALL_VALUES;
		$this->root = $this::ALL_VALUES;
		$this->main = $this::ALL_VALUES;
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
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		if($this->branches) {
			$values[$this->getFilterName() . 'branches'] = $this->getIdValues($this->branches);
		}
		
		if($this->featured != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'featured'] = $this->featured;
		}
		
		if($this->root != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'root'] = $this->root;
		}
		
		if($this->main != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'main'] = $this->main;
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
	
		if($this->categories) {
			$expressions[] = $this->getEqualArrayExpression('mca.category', $this->categories);
		}
		
		if($this->branches) {
			$expressions[] = $this->getEqualArrayExpression('mba.branch', $this->branches);
		}
		
		if($this->featured != SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.featured = ' . $this->featured;
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
		
		if($this->main != SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.main = ' . $this->main;
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
	
		if($this->categories) {
			$expressions[] = MagazineCategoryAssignment::class . ' mca WITH mca.magazine = e.id';
		}
		
		if($this->branches) {
			$expressions[] = MagazineBranchAssignment::class . ' mba WITH mba.magazine = e.id';
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
	private $categories;
	
	/**
	 *
	 * @var array
	 */
	private $branches;
	
	/**
	 *
	 * @var
	 */
	private $featured;
	
	/**
	 *
	 * @var boolean
	 */
	private $root;
	
	/**
	 *
	 * @var boolean
	 */
	private $main;
	
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
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return ArticleFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set branches
	 *
	 * @param array $branches
	 *
	 * @return ArticleFilter
	 */
	public function setBranches($branches)
	{
		$this->branches = $branches;
	
		return $this;
	}
	
	/**
	 * Get branches
	 *
	 * @return array
	 */
	public function getBranches()
	{
		return $this->branches;
	}
	
	/**
	 * Set featured
	 *
	 * @param boolean $featured
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
	 * @return boolean
	 */
	public function getFeatured()
	{
		return $this->featured;
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
	
	/**
	 * Set main
	 *
	 * @param boolean $main
	 *
	 * @return SimpleEntityFilter
	 */
	public function setMain($main)
	{
		$this->main = $main;
	
		return $this;
	}
	
	/**
	 * Get main
	 *
	 * @return boolean
	 */
	public function getMain()
	{
		return $this->main;
	}
}