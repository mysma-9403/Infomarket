<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleCategoryAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $articles = array();
	
	/**
	 *
	 * @var array
	 */
	protected $categories = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->articles = $this->getRequestArray($request, 'articles');
		$this->categories = $this->getRequestArray($request, 'categories');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->articles = array();
		$this->categories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'articles', $this->articles);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}
	
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