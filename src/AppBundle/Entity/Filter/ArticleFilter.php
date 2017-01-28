<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Repository\ArticleCategoryRepository;
use AppBundle\Repository\BrandRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\TagRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class ArticleFilter extends SimpleEntityFilter {
	
	/**
	 * @var ArticleCategoryRepository
	 */
	protected $articleCategoryRepository;
	
	/**
	 * @var CategoryRepository
	 */
	protected $categoryRepository;
	
	/**
	 * @var BrandRepository
	 */
	protected $brandRepository;
	
	/**
	 * @var TagRepository
	 */
	protected $tagRepository;
	
	/**
	 * 
	 * @param ArticleCategoryRepository $articleCategoryRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(
			UserRepository $userRepository,
			ArticleCategoryRepository $articleCategoryRepository, 
			CategoryRepository $categoryRepository,
			BrandRepository $brandRepository, 
			TagRepository $tagRepository) {
		
		parent::__construct($userRepository);
		
		$this->articleCategoryRepository = $articleCategoryRepository;
		$this->categoryRepository = $categoryRepository;
		$this->brandRepository = $brandRepository;
		$this->tagRepository = $tagRepository;
		
		$this->filterName = 'article_filter_';
		
		$this->featured = $this::ALL_VALUES;
		$this->archived = $this::ALL_VALUES;
		$this->main = $this::ALL_VALUES;
		
		$this->pages = [];
		
		$this->active = $this::ALL_VALUES;
	}
	
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
		
		$hiddenCategories = $request->get($this->getFilterName() . 'hidden_categories', array());
		$this->hiddenCategories = $this->categoryRepository->findBy(array('id' => $hiddenCategories));
		
		$brands = $request->get($this->getFilterName() . 'brands', array());
		$this->brands = $this->brandRepository->findBy(array('id' => $brands));
		
		$tags = $request->get($this->getFilterName() . 'tags', array());
		$this->tags = $this->tagRepository->findBy(array('id' => $tags));
		
		$parents = $request->get($this->getFilterName() . 'parents', array());
		$this->parents = $this->categoryRepository->findBy(array('id' => $parents));
		
		$this->pages = $request->get($this->getFilterName() . 'pages', array());
		
		$this->featured = $request->get($this->getFilterName() . 'featured', $this::ALL_VALUES);
		$this->archived = $request->get($this->getFilterName() . 'archived', $this::ALL_VALUES);
		$this->main = $request->get($this->getFilterName() . 'main', $this::ALL_VALUES);
		
		
		$dateFrom = $request->get($this->getFilterName() . 'date_from', null);
		$this->dateFrom = $dateFrom ? new \DateTime($dateFrom) : null;
		
		$dateTo = $request->get($this->getFilterName() . 'date_to', null);
		$this->dateTo = $dateTo ? new \DateTime($dateTo) : null;
		
		$this->active = $request->get($this->getFilterName() . 'active', $this::ALL_VALUES);
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
		$this->hiddenCategories = array();
		$this->brands = array();
		$this->tags= array();
		
		$this->parents = array();
		
		$this->pages = array();
		
		$this->featured = $this::ALL_VALUES;
		$this->archived = $this::ALL_VALUES;
		$this->main = $this::ALL_VALUES;
		
		$this->dateFrom = null;
		$this->dateTo = null;
		
		$this->active = $this::ALL_VALUES;
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
		
		if($this->hiddenCategories) {
			$values[$this->getFilterName() . 'hidden_categories'] = $this->getIdValues($this->hiddenCategories);
		}
		
		if($this->brands) {
			$values[$this->getFilterName() . 'brands'] = $this->getIdValues($this->brands);
		}
		
		if($this->tags) {
			$values[$this->getFilterName() . 'tags'] = $this->getIdValues($this->tags);
		}
		
		if($this->parents) {
			$values[$this->getFilterName() . 'parents'] = $this->getIdValues($this->parents);
		}
		
		if($this->pages) {
			$values[$this->getFilterName() . 'pages'] = $this->pages;
		}
	
		if($this->featured != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'featured'] = $this->featured;
		}
		
		if($this->archived != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'archived'] = $this->archived;
		}
		
		if($this->main != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'main'] = $this->main;
		}
		
		$values[$this->getFilterName() . 'date_from'] = $this->dateFrom ? $this->dateFrom->format('d-m-Y H:i') : null;
		$values[$this->getFilterName() . 'date_to'] = $this->dateTo ? $this->dateTo->format('d-m-Y H:i') : null;
		
		if($this->active != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'active'] = $this->active;
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
		
		if($this->hiddenCategories) {
			$expressions[] = $this->getEqualArrayExpression('aca.category', $this->hiddenCategories);
		}
		
		if($this->branches) {
			$expressions[] = $this->getEqualArrayExpression('bca.branch', $this->branches);
		}
		
		if($this->brands) {
			$expressions[] = $this->getEqualArrayExpression('aba.brand', $this->brands);
		}
		
		if($this->tags) {
			$expressions[] = $this->getEqualArrayExpression('ata.tag', $this->tags);
		}
		
		if($this->pages) {
			$expressions[] = $this->getEqualNumberArrayExpression('e.page', $this->pages);
		}
		
		if($this->featured != SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.featured = ' . $this->featured;
		}
		
		if($this->archived != SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.archived = ' . $this->archived;
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
		
		if($this->dateFrom != null) {
			$expressions[] = 'e.date = \'' . $this->dateFrom->format('Y-m-d H:i') . '\'';
		}
		
		if($this->dateTo != null) {
			$expressions[] = 'e.endDate = \'' . $this->dateTo->format('Y-m-d H:i') . '\'';
		}
		
		if($this->active == SimpleEntityFilter::TRUE_VALUES) {
			$date = new \DateTime();
			
			$expressions[] = '(e.date IS NULL OR e.date <= \'' . $date->format('Y-m-d H:i') . '\')';
			$expressions[] = '(e.endDate IS NULL OR e.endDate >= \'' . $date->format('Y-m-d H:i') . '\')';
		} else if($this->active == SimpleEntityFilter::FALSE_VALUES) {
			$date = new \DateTime();
				
			$expression = 'e.date > \'' . $date->format('Y-m-d H:i') . '\' OR ';
			$expression .= 'e.endDate < \'' . $date->format('Y-m-d H:i') . '\'';
				
			$expressions[] = $expression;
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
		
		if($this->categories || $this->hiddenCategories) {
			$expressions[] = ArticleCategoryAssignment::class . ' aca WITH aca.article = e.id';
		}
		
		if($this->brands) {
			$expressions[] = ArticleBrandAssignment::class . ' aba WITH aba.article = e.id';
		}
		
		if($this->tags) {
			$expressions[] = ArticleTagAssignment::class . ' ata WITH ata.article = e.id';
		}
	
		return $expressions;
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
	 *
	 * @var array
	 */
	private $hiddenCategories;
	
	/**
	 *
	 * @var array
	 */
	private $brands;
	
	/**
	 *
	 * @var array
	 */
	private $branches;
	
	/**
	 *
	 * @var array
	 */
	private $tags;
	
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
	private $archived;
	
	/**
	 * @var boolean
	 */
	private $main;
	
	/**
	 * @var integer
	 */
	private $page;
	
	/**
	 * @var datetime
	 */
	protected $dateFrom;
	
	/**
	 * @var datetime
	 */
	protected $dateTo;
	
	/**
	 * @var boolean
	 */
	protected $active;
	
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
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return ArticleFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set hiddenCategories
	 *
	 * @param array $hiddenCategories
	 *
	 * @return ArticleFilter
	 */
	public function setHiddenCategories($hiddenCategories)
	{
		$this->hiddenCategories = $hiddenCategories;
	
		return $this;
	}
	
	/**
	 * Get hiddenCategories
	 *
	 * @return array
	 */
	public function getHiddenCategories()
	{
		return $this->hiddenCategories;
	}
	
	/**
	 * Set brands
	 *
	 * @param array $brands
	 *
	 * @return ArticleFilter
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
	 * Set tags
	 *
	 * @param array $tags
	 *
	 * @return ArticleFilter
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
	
		return $this;
	}
	
	/**
	 * Get tags
	 *
	 * @return array
	 */
	public function getTags()
	{
		return $this->tags;
	}
	
	/**
	 * Set parents
	 *
	 * @param array $parents
	 *
	 * @return ArticleFilter
	 */
	public function setParents($parents)
	{
		$this->parents = $parents;
	
		return $this;
	}
	
	/**
	 * Get parents
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
	 * Set archived
	 *
	 * @param boolean $archived
	 *
	 * @return SimpleEntityFilter
	 */
	public function setArchived($archived)
	{
		$this->archived = $archived;
	
		return $this;
	}
	
	/**
	 * Is archived
	 *
	 * @return boolean
	 */
	public function isArchived()
	{
		return $this->archived;
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
	
	/**
	 * Set pages
	 *
	 * @param array $pages
	 *
	 * @return ArticleFilter
	 */
	public function setPages($pages)
	{
		$this->pages = $pages;
	
		return $this;
	}
	
	/**
	 * Get pages
	 *
	 * @return array
	 */
	public function getPages()
	{
		return $this->pages;
	}
	
	/**
	 * Set dateFrom
	 *
	 * @param \DateTime $dateFrom
	 *
	 * @return Advert
	 */
	public function setDateFrom($dateFrom)
	{
		$this->dateFrom = $dateFrom;
	
		return $this;
	}
	
	/**
	 * Get dateFrom
	 *
	 * @return \DateTime
	 */
	public function getDateFrom()
	{
		return $this->dateFrom;
	}
	
	/**
	 * Set dateTo
	 *
	 * @param \DateTime $dateTo
	 *
	 * @return Advert
	 */
	public function setDateTo($dateTo)
	{
		$this->dateTo = $dateTo;
	
		return $this;
	}
	
	/**
	 * Get dateTo
	 *
	 * @return \DateTime
	 */
	public function getDateTo()
	{
		return $this->dateTo;
	}
	
	/**
	 * Set active
	 *
	 * @param boolean $active
	 *
	 * @return SimpleEntityFilter
	 */
	public function setActive($active)
	{
		$this->active = $active;
	
		return $this;
	}
	
	/**
	 * Is active
	 *
	 * @return boolean
	 */
	public function isActive()
	{
		return $this->active;
	}
}