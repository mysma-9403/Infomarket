<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Repository\BrandRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Segment;
use AppBundle\Repository\UserRepository;

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
			CategoryRepository $categoryRepository, 
			SegmentRepository $segmentRepository) {
		
		parent::__construct($userRepository);
		
		$this->brandRepository = $brandRepository;
		$this->categoryRepository = $categoryRepository;
		$this->segmentRepository = $segmentRepository;
		
		$this->filterName = 'brand_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, c.subname ASC, s.orderNumber ASC, b.name ASC';
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
	 * @var SegmentRepository
	 */
	protected $segmentRepository;
	
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
		
		$segments = $request->get($this->getFilterName() . 'segments', array());
		$this->segments = $this->segmentRepository->findBy(array('id' => $segments));
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
		$this->segments = array();
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
		
		if($this->segments) {
			$values[$this->getFilterName() . 'segments'] = $this->getIdValues($this->segments);
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
		
		if($this->segments) {
			$expressions[] = $this->getEqualArrayExpression('e.segment', $this->segments);
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
		$expressions[] = Segment::class . ' s WITH e.segment = s.id';
	
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
	 *
	 * @var array
	 */
	private $segments;
	
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
	
	/**
	 * Set segments
	 *
	 * @param array $segments
	 *
	 * @return BrandCategoryAssignmentFilter
	 */
	public function setSegments($segments)
	{
		$this->segments = $segments;
	
		return $this;
	}
	
	/**
	 * Get brand segments
	 *
	 * @return array
	 */
	public function getSegments()
	{
		return $this->segments;
	}
}