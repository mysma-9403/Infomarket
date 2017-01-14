<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class BrandFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @param UserRepository $userRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(UserRepository $userRepository, CategoryRepository $categoryRepository) {
		parent::__construct($userRepository);
		
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'brand_filter_';
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
			$expressions[] = BrandCategoryAssignment::class . ' bca WITH bca.brand = e.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var integer
	 */
	private $categories;
	
	/**
	 * Set brand categories
	 *
	 * @param array $categories
	 *
	 * @return BrandFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get branch
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}