<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Advert;
use AppBundle\Entity\Category;
use AppBundle\Repository\AdvertCategoryAssignmentRepository;
use AppBundle\Repository\AdvertRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class AdvertCategoryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param AdvertCategoryAssignmentRepository $advertRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(AdvertRepository $advertRepository, CategoryRepository $categoryRepository) {
		parent::__construct();
		
		$this->advertRepository = $advertRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'advert_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, c.subname ASC, a.name ASC';
	}
	
	/**
	 * @var AdvertCategoryAssignmentCategoryRepository
	 */
	protected $advertRepository;
	
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
	
		$adverts = $request->get($this->getFilterName() . 'adverts', array());
		$this->adverts = $this->advertRepository->findBy(array('id' => $adverts));
		
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
	
		$this->adverts = array();
		$this->categories = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->adverts) {
			$values[$this->getFilterName() . 'adverts'] = $this->getIdValues($this->adverts);
		}
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->adverts) {
			$expressions[] = $this->getEqualArrayExpression('e.advert', $this->adverts);
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
		
		$expressions[] = Advert::class . ' a WITH e.advert = a.id';
		$expressions[] = Category::class . ' c WITH e.category = c.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $adverts;
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 * Set adverts
	 *
	 * @param array $adverts
	 *
	 * @return AdvertCategoryAssignmentFilter
	 */
	public function setAdverts($adverts)
	{
		$this->adverts = $adverts;
	
		return $this;
	}
	
	/**
	 * Get adverts
	 *
	 * @return array
	 */
	public function getAdverts()
	{
		return $this->adverts;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return AdvertCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get advert categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}