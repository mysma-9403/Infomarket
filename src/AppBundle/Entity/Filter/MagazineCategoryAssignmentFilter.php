<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Category;
use AppBundle\Entity\Magazine;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\MagazineRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class MagazineCategoryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param UserRepository $userRepository
	 * @param MagazineRepository $magazineRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(
			UserRepository $userRepository, 
			MagazineRepository $magazineRepository, 
			CategoryRepository $categoryRepository) {
		
		parent::__construct($userRepository);
		
		$this->magazineRepository = $magazineRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'magazine_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, c.subname ASC, m.date DESC, m.name ASC';
	}
	
	/**
	 * @var MagazineCategoryAssignmentCategoryRepository
	 */
	protected $magazineRepository;
	
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
	
		$magazines = $request->get($this->getFilterName() . 'magazines', array());
		$this->magazines = $this->magazineRepository->findBy(array('id' => $magazines));
		
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
	
		$this->magazines = array();
		$this->categories = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->magazines) {
			$values[$this->getFilterName() . 'magazines'] = $this->getIdValues($this->magazines);
		}
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->magazines) {
			$expressions[] = $this->getEqualArrayExpression('e.magazine', $this->magazines);
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
		
		$expressions[] = Magazine::class . ' m WITH e.magazine = m.id';
		$expressions[] = Category::class . ' c WITH e.category = c.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $magazines;
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 * Set magazines
	 *
	 * @param array $magazines
	 *
	 * @return MagazineCategoryAssignmentFilter
	 */
	public function setMagazines($magazines)
	{
		$this->magazines = $magazines;
	
		return $this;
	}
	
	/**
	 * Get magazines
	 *
	 * @return array
	 */
	public function getMagazines()
	{
		return $this->magazines;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return MagazineCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get magazine categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}