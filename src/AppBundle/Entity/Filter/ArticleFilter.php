<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Repository\ArticleCategoryRepository;
use AppBundle\Repository\BrandRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\TagRepository;
use AppBundle\Entity\ArticleTagAssignment;

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
	public function __construct(ArticleCategoryRepository $articleCategoryRepository, 
								CategoryRepository $categoryRepository, 
								BrandRepository $brandRepository, 
								TagRepository $tagRepository) {
		parent::__construct();
		
		$this->articleCategoryRepository = $articleCategoryRepository;
		$this->categoryRepository = $categoryRepository;
		$this->brandRepository = $brandRepository;
		$this->tagRepository = $tagRepository;
		
		$this->filterName = 'article_filter_';
		
		$this->featured = $this::ALL_VALUES;
		$this->main = $this::ALL_VALUES;
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
		
		$brands = $request->get($this->getFilterName() . 'brands', array());
		$this->brands = $this->brandRepository->findBy(array('id' => $brands));
		
		$tags = $request->get($this->getFilterName() . 'tags', array());
		$this->tags = $this->tagRepository->findBy(array('id' => $tags));
		
		$parents = $request->get($this->getFilterName() . 'parents', array());
		$this->parents = $this->categoryRepository->findBy(array('id' => $parents));
		
		$this->featured = $request->get($this->getFilterName() . 'featured', $this::ALL_VALUES);
		$this->main = $request->get($this->getFilterName() . 'main', $this::ALL_VALUES);
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
		$this->brands = array();
		$this->tags= array();
		
		$this->parents = array();
		
		$this->featured = $this::ALL_VALUES;
		$this->main = $this::ALL_VALUES;
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
		
		if($this->brands) {
			$values[$this->getFilterName() . 'brands'] = $this->getIdValues($this->brands);
		}
		
		if($this->tags) {
			$values[$this->getFilterName() . 'tags'] = $this->getIdValues($this->tags);
		}
		
		if($this->parents) {
			$values[$this->getFilterName() . 'parents'] = $this->getIdValues($this->parents);
		}
	
		if($this->featured !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'featured'] = $this->featured;
		}
		
		if($this->main !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'main'] = $this->main;
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
		
		if($this->brands) {
			$expressions[] = $this->getEqualArrayExpression('aba.brand', $this->brands);
		}
		
		if($this->tags) {
			$expressions[] = $this->getEqualArrayExpression('ata.tag', $this->tags);
		}
		
		if($this->featured !== SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.featured = ' . $this->featured;
		}
		
		if($this->main === SimpleEntityFilter::TRUE_VALUES) {
			$expressions[] = 'e.parent IS NULL';
		} else {
			if($this->main === SimpleEntityFilter::FALSE_VALUES) {
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
		
		if($this->categories) {
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
	private $brands;
	
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