<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Term;
use AppBundle\Entity\Category;
use AppBundle\Repository\TermCategoryAssignmentRepository;
use AppBundle\Repository\TermRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class TermCategoryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param TermCategoryAssignmentRepository $termRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(TermRepository $termRepository, CategoryRepository $categoryRepository) {
		parent::__construct();
		
		$this->termRepository = $termRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'term_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, c.subname ASC, a.name ASC';
	}
	
	/**
	 * @var TermCategoryAssignmentCategoryRepository
	 */
	protected $termRepository;
	
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
	
		$terms = $request->get($this->getFilterName() . 'terms', array());
		$this->terms = $this->termRepository->findBy(array('id' => $terms));
		
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
	
		$this->terms = array();
		$this->categories = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->terms) {
			$values[$this->getFilterName() . 'terms'] = $this->getIdValues($this->terms);
		}
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->terms) {
			$expressions[] = $this->getEqualArrayExpression('e.term', $this->terms);
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
		
		$expressions[] = Term::class . ' a WITH e.term = a.id';
		$expressions[] = Category::class . ' c WITH e.category = c.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $terms;
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 * Set terms
	 *
	 * @param array $terms
	 *
	 * @return TermCategoryAssignmentFilter
	 */
	public function setTerms($terms)
	{
		$this->terms = $terms;
	
		return $this;
	}
	
	/**
	 * Get terms
	 *
	 * @return array
	 */
	public function getTerms()
	{
		return $this->terms;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return TermCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get term categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}