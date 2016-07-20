<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use AppBundle\Repository\ProductRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Segment;

class ProductCategoryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param ProductRepository $productRepository
	 * @param CategoryRepository $categoryRepository
	 * @param SegmentRepository $segmentRepository
	 */
	public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository, SegmentRepository $segmentRepository) {
		parent::__construct();
		
		$this->productRepository = $productRepository;
		$this->categoryRepository = $categoryRepository;
		$this->segmentRepository = $segmentRepository;
		
		$this->filterName = 'product_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, c.subname ASC, s.orderNumber ASC, p.name ASC';
	}
	
	/**
	 * @var ProductCategoryAssignmentCategoryRepository
	 */
	protected $productRepository;
	
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
	
		$products = $request->get($this->getFilterName() . 'products', array());
		$this->products = $this->productRepository->findBy(array('id' => $products));
		
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
	
		$this->products = array();
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
	
		if($this->products) {
			$values[$this->getFilterName() . 'products'] = $this->getIdValues($this->products);
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
		
		if($this->products) {
			$expressions[] = $this->getEqualArrayExpression('e.product', $this->products);
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
		
		$expressions[] = Product::class . ' p WITH e.product = p.id';
		$expressions[] = Category::class . ' c WITH e.category = c.id';
		$expressions[] = Segment::class . ' s WITH e.segment = s.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $products;
	
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
	 * Set products
	 *
	 * @param array $products
	 *
	 * @return ProductCategoryAssignmentFilter
	 */
	public function setProducts($products)
	{
		$this->products = $products;
	
		return $this;
	}
	
	/**
	 * Get products
	 *
	 * @return array
	 */
	public function getProducts()
	{
		return $this->products;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return ProductCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get product categories
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
	 * @return ProductCategoryAssignmentFilter
	 */
	public function setSegments($segments)
	{
		$this->segments = $segments;
	
		return $this;
	}
	
	/**
	 * Get product segments
	 *
	 * @return array
	 */
	public function getSegments()
	{
		return $this->segments;
	}
}