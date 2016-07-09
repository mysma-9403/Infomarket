<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\ArticleCategoryRepository;
use AppBundle\Entity\ArticleArticleCategoryAssignment;

class ArticleFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param ArticleCategoryRepository $articleCategoryRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(ArticleCategoryRepository $articleCategoryRepository, CategoryRepository $categoryRepository) {
		$this->articleCategoryRepository = $articleCategoryRepository;
		$this->categoryRepository = $categoryRepository;
		$this->filterName = 'article_filter_';
		
		$this->featured = $this::ALL_VALUES;
	}
	
	/**
	 * @var ArticleCategoryRepository
	 */
	protected $articleCategoryRepository;
	
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
	
		$articleCategories = $request->get($this->getFilterName() . 'article_categories', array());
		$this->articleCategories = $this->articleCategoryRepository->findBy(array('id' => $articleCategories));
		
		$categories = $request->get($this->getFilterName() . 'categories', array());
		$this->categories = $this->categoryRepository->findBy(array('id' => $categories));
		
		$parents = $request->get($this->getFilterName() . 'parents', array());
		$this->parents = $this->categoryRepository->findBy(array('id' => $parents));
		
		$this->featured = $request->get($this->getFilterName() . 'featured', SimpleEntityFilter::ALL_VALUES);
		$this->main = $request->get($this->getFilterName() . 'main', SimpleEntityFilter::ALL_VALUES);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->articleCategories = array();
		$this->categories = array();
		$this->parents = array();
		
		$this->featured = SimpleEntityFilter::ALL_VALUES;
		$this->main = SimpleEntityFilter::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->articleCategories) {
			$values[$this->getFilterName() . 'article_categories'] = $this->getIdValues($this->articleCategories);
		}
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		if($this->parents) {
			$values[$this->getFilterName() . 'parents'] = $this->getIdValues($this->parents);
		}
	
		if($this->featured == SimpleEntityFilter::TRUE_VALUES) {
			$values[$this->getFilterName() . 'featured'] = true;
		} else if($this->featured == SimpleEntityFilter::FALSE_VALUES) {
			$values[$this->getFilterName() . 'featured'] = false;
		}
		
		if($this->main == SimpleEntityFilter::TRUE_VALUES) {
			$values[$this->getFilterName() . 'main'] = true;
		} else if($this->main == SimpleEntityFilter::FALSE_VALUES) {
			$values[$this->getFilterName() . 'main'] = false;
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->articleCategories) {
			$expressions[] = $this->getEqualArrayExpression('aaca.articleCategory', $this->articleCategories);
		}
		
		if($this->categories) {
			$expressions[] = $this->getEqualArrayExpression('aca.category', $this->categories);
		}
		
		if($this->featured == SimpleEntityFilter::TRUE_VALUES) {
			$expressions[] = 'e.featured = 1';
		} else if($this->featured == SimpleEntityFilter::FALSE_VALUES) {
			$expressions[] = 'e.featured = 0';
		}
		
		if($this->main == SimpleEntityFilter::TRUE_VALUES) {
			$expressions[] = 'e.parent IS NULL';
		} else {
			if($this->main == SimpleEntityFilter::FALSE_VALUES) {
				$expressions[] = 'e.parent IS NOT NULL';
			}
			if($this->parents) {
				$expressions[] = $this->getEqualArrayExpression('e.parent', $this->parents);
			}
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
	
		if($this->articleCategories) {
			$expressions[] = ArticleArticleCategoryAssignment::class . ' aaca WITH aaca.article = e.id';
		}
		
		if($this->categories || $this->parents) {
			$expressions[] = ArticleCategoryAssignment::class . ' aca WITH aca.article = e.id';
		}
	
		return $expressions;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return ' ORDER BY e.orderNumber ASC, e.name ASC ';
	}
	
	/**
	 *
	 * @var array
	 */
	private $articleCategories;
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 * @var array
	 */
	private $parents;
	
	/**
	 * @var boolean
	 */
	private $featured;
	
	/**
	 * @var boolean
	 */
	private $main;
	
	/**
	 * Set article categories
	 *
	 * @param array $articleCategories
	 *
	 * @return ArticleFilter
	 */
	public function setArticleCategories($articleCategories)
	{
		$this->articleCategories = $articleCategories;
	
		return $this;
	}
	
	/**
	 * Get article categories
	 *
	 * @return array
	 */
	public function getArticleCategories()
	{
		return $this->articleCategories;
	}
	
	/**
	 * Set article categories
	 *
	 * @param array $articleCategories
	 *
	 * @return ArticleFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get article categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set article categories
	 *
	 * @param array $articleCategories
	 *
	 * @return ArticleFilter
	 */
	public function setParents($parents)
	{
		$this->parents = $parents;
	
		return $this;
	}
	
	/**
	 * Get article categories
	 *
	 * @return array
	 */
	public function getParents()
	{
		return $this->parents;
	}
	
	/**
	 * Set featured
	 *
	 * @param boolean $featured
	 *
	 * @return SimpleEntityFilter
	 */
	public function setFeatured($featured)
	{
		$this->featured = $featured;
	
		return $this;
	}
	
	/**
	 * Is featured
	 *
	 * @return boolean
	 */
	public function isFeatured()
	{
		return $this->featured;
	}
	
	/**
	 * Set main
	 *
	 * @param boolean $main
	 *
	 * @return SimpleEntityFilter
	 */
	public function setMain($main)
	{
		$this->main = $main;
	
		return $this;
	}
	
	/**
	 * Is main
	 *
	 * @return boolean
	 */
	public function isMain()
	{
		return $this->main;
	}
}