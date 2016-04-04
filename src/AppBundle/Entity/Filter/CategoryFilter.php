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
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getFilterName()
	 */
	protected function getFilterName() {
		return 'category_filter_';
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
		$branches = $request->get($this->getFilterName() . 'branches', array());
		$this->branches = $this->branchRepository->findBy(array('id' => $branches));
	
		$parents = $request->get($this->getFilterName() . 'parents', array());
		$this->parents = $this->categoryRepository->findBy(array('id' => $parents));
	
		$root = $request->get($this->getFilterName() . 'root', false);
		$this->root = $root;
		
		$preleaf = $request->get($this->getFilterName() . 'preleaf', false);
		$this->preleaf = $preleaf;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		$this->branches = array();
		$this->parents = array();
		$this->root = false;
		$this->preleaf = false;
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
		
		if($this->root) {
			$values[$this->getFilterName() . 'root'] = $this->root;
		}
		
		if($this->preleaf) {
			$values[$this->getFilterName() . 'preleaf'] = $this->preleaf;
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
	
		if($this->root) {
			$expressions[] = 'e.parent IS NULL';
		} else if($this->parents) {
			$expressions[] = $this->getEqualArrayExpression('e.parent', $this->parents);
		}
		
		if($this->preleaf) {
			$expressions[] = 'e.preleaf = ' . $this->preleaf;
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
	 * @var array
	 */
	private $branches;
	
	/**
	 *
	 * @var array
	 */
	private $parents;
	
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