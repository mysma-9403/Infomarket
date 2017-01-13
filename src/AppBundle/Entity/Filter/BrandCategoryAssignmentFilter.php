<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Repository\BrandRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\SegmentRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class BrandCategoryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param BrandRepository $brandRepository
	 * @param CategoryRepository $categoryRepository
	 * @param SegmentRepository $segmentRepository
	 */
	public function __construct(
			UserRepository $userRepository, 
			BrandRepository $brandRepository, 
			CategoryRepository $categoryRepository) {
		
		parent::__construct($userRepository);
		
		$this->brandRepository = $brandRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'brand_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, c.subname ASC, b.name ASC';
	}
	
	/**
	 * @var BrandCategoryAssignmentCategoryRepository
	 */
	protected $brandRepository;
	
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
	
		$brands = $request->get($this->getFilterName() . 'brands', array());
		$this->brands = $this->brandRepository->findBy(array('id' => $brands));
		
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
	
		$this->brands = array();
		$this->categories = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->brands) {
			$values[$this->getFilterName() . 'brands'] = $this->getIdValues($this->brands);
		}
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->brands) {
			$expressions[] = $this->getEqualArrayExpression('e.brand', $this->brands);
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
		
		$expressions[] = Brand::class . ' b WITH e.brand = b.id';
		$expressions[] = Category::class . ' c WITH e.category = c.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $brands;
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 * Set brands
	 *
	 * @param array $brands
	 *
	 * @return BrandCategoryAssignmentFilter
	 */
	public function setBrands($brands)
	{
		$this->brands = $brands;
	
		return $this;
	}
	
	/**
	 * Get brands
	 *
	 * @return array
	 */
	public function getBrands()
	{
		return $this->brands;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return BrandCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get brand categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}