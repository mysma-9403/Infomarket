<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Repository\BrandRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;

class ProductFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @param CategoryRepository $categoryRepository
	 * @param BrandRepository $brandRepository
	 * @param SegmentRepository $segmentRepository
	 */
	public function __construct(CategoryRepository $categoryRepository, 
								BrandRepository $brandRepository, 
								SegmentRepository $segmentRepository) {
		$this->categoryRepository = $categoryRepository;
		$this->brandRepository = $brandRepository;
		$this->segmentRepository = $segmentRepository;
		
		$this->filterName = 'product_filter_';
	}
	
	/**
	 * @var CategoryRepository
	 */
	protected $categoryRepository;
	
	/**
	 * @var BrandRepository
	 */
	protected $brandRepository;
	
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
		
		$categories = $request->get('categories', array());
		$this->categories = $this->categoryRepository->findBy(array('id' => $categories));
		
		$brands = $request->get('brands', array());
		$this->brands = $this->brandRepository->findBy(array('id' => $brands));
		
		$segments = $request->get('segments', array());
		$this->segments = $this->brandRepository->findBy(array('id' => $segments));
	}

	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() { 
		parent::clearMoreQueryValues();
		
		$this->categories = array();
		$this->brands = array();
		$this->segments= array();
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
		
		$values['categories'] = $this->getIdValues($this->categories);
		$values['brands'] = $this->getIdValues($this->brands);
		$values['segments'] = $this->getIdValues($this->segments);
		
		return $values;
	}
	
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
	
		if($this->categories || $this->segments)
			$expressions[] = ProductCategoryAssignment::class . ' pca WITH pca.product = e.id';
	
		return $expressions;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getWhereExpressions()
	 */
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->brands) {
			$expressions[] = $this->getEqualArrayExpression('e.brand', $this->brands);
		}
		
		if($this->categories)
			$expressions[] = $this->getEqualArrayExpression('pca.category', $this->categories);
		
		if($this->segments)
			$expressions[] = $this->getEqualArrayExpression('pca.segment', $this->segments);
		
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 *
	 * @var array
	 */
	private $brands;
	
	/**
	 *
	 * @var array
	 */
	private $segments;
	
	/**
	 * Set product categories
	 *
	 * @param array $categories
	 *
	 * @return ProductFilter
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
	 * Set product brands
	 *
	 * @param array $brands
	 *
	 * @return ProductFilter
	 */
	public function setBrands($brands)
	{
		$this->brands = $brands;
	
		return $this;
	}
	
	/**
	 * Get product brands
	 *
	 * @return array
	 */
	public function getBrands()
	{
		return $this->brands;
	}
	
	/**
	 * Set product segments
	 *
	 * @param array $segments
	 *
	 * @return ProductFilter
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