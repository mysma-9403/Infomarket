<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;

class BrandFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @param CategoryRepository $categoryRepository
	 * @param SegmentRepository $segmentRepository
	 */
	public function __construct(CategoryRepository $categoryRepository, SegmentRepository $segmentRepository) {
		parent::__construct();
		
		$this->categoryRepository = $categoryRepository;
		$this->segmentRepository = $segmentRepository;
		
		$this->filterName = 'brand_filter_';
	}
	
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
	
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		if($this->segments) {
			$values[$this->getFilterName() . 'segments'] = $this->getIdValues($this->segments);
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
	
		if($this->segments) {
			$expressions[] = $this->getEqualArrayExpression('bca.segment', $this->segments);
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
	
		if($this->categories || $this->segments)
			$expressions[] = BrandCategoryAssignment::class . ' bca WITH bca.brand = e.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var integer
	 */
	private $categories;
	
	/**
	 *
	 * @var integer
	 */
	private $segments;
	
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
	
	/**
	 * Set brand segments
	 *
	 * @param array $segments
	 *
	 * @return BrandFilter
	 */
	public function setSegments($segments)
	{
		$this->segments = $segments;
	
		return $this;
	}
	
	/**
	 * Get segments
	 *
	 * @return array
	 */
	public function getSegments()
	{
		return $this->segments;
	}
}