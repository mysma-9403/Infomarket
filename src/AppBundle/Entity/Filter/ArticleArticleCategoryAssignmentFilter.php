<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Repository\ArticleCategoryAssignmentRepository;
use AppBundle\Repository\ArticleCategoryRepository;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class ArticleArticleCategoryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param ArticleCategoryAssignmentRepository $articleRepository
	 * @param ArticleCategoryRepository $articleCategoryRepository
	 */
	public function __construct(
			UserRepository $userRepository, 
			ArticleRepository $articleRepository, 
			ArticleCategoryRepository $articleCategoryRepository) {
		
		parent::__construct($userRepository);
		
		$this->articleRepository = $articleRepository;
		$this->articleCategoryRepository = $articleCategoryRepository;
		
		$this->filterName = 'article_article_category_assignment_filter_';
		
		$this->orderBy = 'c.name ASC, a.name ASC, a.subname ASC';
	}
	
	/**
	 * @var ArticleCategoryAssignmentCategoryRepository
	 */
	protected $articleRepository;
	
	/**
	 * @var CategoryRepository
	 */
	protected $articleCategoryRepository;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$articles = $request->get($this->getFilterName() . 'articles', array());
		$this->articles = $this->articleRepository->findBy(array('id' => $articles));
		
		$articleCategories = $request->get($this->getFilterName() . 'article_categories', array());
		$this->articleCategories = $this->articleCategoryRepository->findBy(array('id' => $articleCategories));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->articles = array();
		$this->articleCategories = array();
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
		
		if($this->articleCategories) {
			$values[$this->getFilterName() . 'article_categories'] = $this->getIdValues($this->articleCategories);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->articles) {
			$expressions[] = $this->getEqualArrayExpression('e.article', $this->articles);
		}
		
		if($this->articleCategories) {
			$expressions[] = $this->getEqualArrayExpression('e.articleCategory', $this->articleCategories);
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
		$expressions[] = ArticleCategory::class . ' c WITH e.articleCategory = c.id';
	
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
	private $articleCategories;
	
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
	 * Set article categories
	 *
	 * @param array $articleCategories
	 *
	 * @return ArticleCategoryAssignmentFilter
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
}