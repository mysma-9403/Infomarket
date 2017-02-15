<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleArticleCategoryAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $articles = array();
	
	/**
	 *
	 * @var array
	 */
	protected $articleCategories = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->articles = $this->getRequestArray($request, 'articles');
		$this->articleCategories = $this->getRequestArray($request, 'article_categories');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->articles = array();
		$this->articleCategories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'articles', $this->articles);
		$this->setRequestArray($values, 'article_categories', $this->articleCategories);
		
		return $values;
	}
	
	/**
	 * Set articles
	 *
	 * @param array $articles
	 *
	 * @return ArticleArticleCategoryAssignmentFilter
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
	 * Set articleCategories
	 *
	 * @param array $articleCategories
	 *
	 * @return ArticleArticleCategoryAssignmentFilter
	 */
	public function setArticleCategories($articleCategories)
	{
		$this->articleCategories = $articleCategories;
	
		return $this;
	}
	
	/**
	 * Get article articleCategories
	 *
	 * @return array
	 */
	public function getArticleCategories()
	{
		return $this->articleCategories;
	}
}