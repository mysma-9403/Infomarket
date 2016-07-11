<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\BranchRepository;
use Symfony\Component\HttpFoundation\Request;

class CategoryFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @param BranchRepository $branchRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(BranchRepository $branchRepository, CategoryRepository $categoryRepository) {
		$this->branchRepository = $branchRepository;
		$this->categoryRepository = $categoryRepository;
		$this->filterName = 'category_filter_';
		
		$this->featured = SimpleEntityFilter::ALL_VALUES;
		$this->preleaf = SimpleEntityFilter::ALL_VALUES;
	}
	
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
		
		$branches = $request->get($this->getFilterName() . 'branches', array());
		$this->branches = $this->branchRepository->findBy(array('id' => $branches));
	
		$parents = $request->get($this->getFilterName() . 'parents', array());
		$this->parents = $this->categoryRepository->findBy(array('id' => $parents));
		
		$this->subname = $request->get($this->getFilterName() . 'subname', null);
		
		$this->featured = $request->get($this->getFilterName() . 'featured', SimpleEntityFilter::ALL_VALUES);
		$this->preleaf = $request->get($this->getFilterName() . 'preleaf', SimpleEntityFilter::ALL_VALUES);
		$this->root = $request->get($this->getFilterName() . 'root', SimpleEntityFilter::ALL_VALUES);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
		
		$this->branches = array();
		$this->parents = array();
		
		$this->subname = null;
		
		$this->featured = SimpleEntityFilter::ALL_VALUES;
		$this->preleaf = SimpleEntityFilter::ALL_VALUES;
		$this->root = SimpleEntityFilter::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->branches) {
			$values[$this->getFilterName() . 'branches'] = $this->getIdValues($this->branches);
		}
		
		if($this->parents) {
			$values[$this->getFilterName() . 'parents'] = $this->getIdValues($this->parents);
		}
		
		if($this->subname) {
			$values[$this->getFilterName() . 'subname'] = $this->subname;
		}
		
		if($this->featured == SimpleEntityFilter::TRUE_VALUES) {
			$values[$this->getFilterName() . 'featured'] = true;
		} else if($this->featured == SimpleEntityFilter::FALSE_VALUES) {
			$values[$this->getFilterName() . 'featured'] = false;
		}
		
		if($this->preleaf == SimpleEntityFilter::TRUE_VALUES) {
			$values[$this->getFilterName() . 'preleaf'] = true;
		} else if($this->preleaf == SimpleEntityFilter::FALSE_VALUES) {
			$values[$this->getFilterName() . 'preleaf'] = false;
		}
		
		if($this->root == SimpleEntityFilter::TRUE_VALUES) {
			$values[$this->getFilterName() . 'root'] = true;
		} else if($this->root == SimpleEntityFilter::FALSE_VALUES) {
			$values[$this->getFilterName() . 'root'] = false;
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
	
		if($this->branches) {
			$expressions[] = $this->getEqualArrayExpression('bca.branch', $this->branches);
		}
		
		if($this->subname) {
			$expressions[] = 'e.subname like \'%' . $this->subname . '%\'';
		}
		
		if($this->featured != SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.featured = ' . $this->featured;
		}
		
// 		if($this->preleaf != SimpleEntityFilter::ALL_VALUES) {
// 			$expressions[] = 'e.preleaf = ' . $this->preleaf;
// 		}
		
		if($this->root == SimpleEntityFilter::TRUE_VALUES) {
			$expressions[] = 'e.parent IS NULL';
		} else {
			if($this->root == SimpleEntityFilter::FALSE_VALUES) {
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
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getJoinExpressions()
	 */
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
		
		if($this->branches)
			$expressions[] = BranchCategoryAssignment::class . ' bca WITH bca.category = e.id';
		
		return $expressions;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return ' ORDER BY e.treePath ASC ';
	}
	
	/**
	 *
	 * @var string
	 */
	private $subname;
	
	/**
	 *
	 * @var boolean
	 */
	private $root;
	
	/**
	 *
	 * @var boolean
	 */
	private $preleaf;
	
	/**
	 *
	 * @var boolean
	 */
	private $featured;
	
	/**
	 *
	 * @var array
	 */
	private $branches;
	
	/**
	 *
	 * @var array
	 */
	private $parents;
	
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
	 * Set preleaf
	 *
	 * @param boolean $preleaf
	 *
	 * @return SimpleEntityFilter
	 */
	public function setPreleaf($preleaf)
	{
		$this->preleaf = $preleaf;
	
		return $this;
	}
	
	/**
	 * Get preleaf
	 *
	 * @return boolean
	 */
	public function getPreleaf()
	{
		return $this->preleaf;
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
	 * Set product branches
	 *
	 * @param array $branches
	 *
	 * @return ProductFilter
	 */
	public function setBranches($branches)
	{
		$this->branches = $branches;
	
		return $this;
	}
	
	/**
	 * Get product branches
	 *
	 * @return array
	 */
	public function getBranches()
	{
		return $this->branches;
	}
	
	/**
	 * Set product parents
	 *
	 * @param array $parents
	 *
	 * @return ProductFilter
	 */
	public function setParents($parents)
	{
		$this->parents = $parents;
	
		return $this;
	}
	
	/**
	 * Get product parents
	 *
	 * @return array
	 */
	public function getParents()
	{
		return $this->parents;
	}
}