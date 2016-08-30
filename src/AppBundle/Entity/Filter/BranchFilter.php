<?php

namespace AppBundle\Entity\Filter;

use AppBundle;
use AppBundle\Entity\Filter\Base\ImageEntityFilter;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Repository\UserRepository;

class BranchFilter extends ImageEntityFilter {
	
	/**
	 *
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(UserRepository $userRepository, CategoryRepository $categoryRepository) {
		parent::__construct($userRepository);
		
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'branch_filter_';
	}
	
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
	
		$this->categories = array();
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
			$expressions[] = $this->getEqualArrayExpression('bca.category', $this->categories);
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
	
		if($this->categories)
			$expressions[] = BranchCategoryAssignment::class . ' bca WITH bca.branch = e.id';
	
			return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 * Set branch categories
	 *
	 * @param array $categories
	 *
	 * @return BranchFilter
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