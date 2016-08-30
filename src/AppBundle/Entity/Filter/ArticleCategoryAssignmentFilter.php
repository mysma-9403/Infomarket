<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Repository\ArticleCategoryAssignmentRepository;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class ArticleCategoryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param ArticleCategoryAssignmentRepository $articleRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(
			UserRepository $userRepository, 
			ArticleRepository $articleRepository, 
			CategoryRepository $categoryRepository) {
		
		parent::__construct($userRepository);
		
		$this->articleRepository = $articleRepository;
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'article_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, c.subname ASC, a.name ASC, a.subname ASC';
	}
	
	/**
	 * @var ArticleCategoryAssignmentCategoryRepository
	 */
	protected $articleRepository;
	
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
	
		$articles = $request->get($this->getFilterName() . 'articles', array());
		$this->articles = $this->articleRepository->findBy(array('id' => $articles));
		
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
	
		$this->articles = array();
		$this->categories = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->articles) {
			$values[$this->getFilterName() . 'articles'] = $this->getIdValues($this->articles);
		}
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->articles) {
			$expressions[] = $this->getEqualArrayExpression('e.article', $this->articles);
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
		
		$expressions[] = Article::class . ' a WITH e.article = a.id';
		$expressions[] = Category::class . ' c WITH e.category = c.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $articles;
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 * Set articles
	 *
	 * @param array $articles
	 *
	 * @return ArticleCategoryAssignmentFilter
	 */
	public function setArticles($articles)
	{
		$this->articles = $articles;
	
		return $this;
	}
	
	/**
	 * Get articles
	 *
	 * @return array
	 */
	public function getArticles()
	{
		return $this->articles;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return ArticleCategoryAssignmentFilter
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
}