<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Repository\BranchRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class BranchCategoryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param BranchRepository $branchRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(BranchRepository $branchRepository, CategoryRepository $categoryRepository) {
		parent::__construct();
		
		$this->branchRepository = $branchRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'branch_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, c.subname ASC, b.name ASC';
	}
	
	/**
	 * @var BranchCategoryAssignmentCategoryRepository
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
	
		$this->branches = array();
		$this->categories = array();
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
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->branches) {
			$expressions[] = $this->getEqualArrayExpression('e.branch', $this->branches);
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
		
		$expressions[] = Branch::class . ' b WITH e.branch = b.id';
		$expressions[] = Category::class . ' c WITH e.category = c.id';
	
		return $expressions;
	}
	
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
	 * Set branches
	 *
	 * @param array $branches
	 *
	 * @return BranchCategoryAssignmentFilter
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
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return BranchCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get branch categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}