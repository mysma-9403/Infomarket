<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleTagAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $articles = array();
	
	/**
	 *
	 * @var array
	 */
	protected $tags = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->articles = $this->getRequestArray($request, 'articles');
		$this->tags = $this->getRequestArray($request, 'tags');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->articles = array();
		$this->tags = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'articles', $this->articles);
		$this->setRequestArray($values, 'tags', $this->tags);
		
		return $values;
	}
	
	/**
	 * Set articles
	 *
	 * @param array $articles
	 *
	 * @return ArticleTagAssignmentFilter
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
	 * Set tags
	 *
	 * @param array $tags
	 *
	 * @return ArticleTagAssignmentFilter
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
	
		return $this;
	}
	
	/**
	 * Get article tags
	 *
	 * @return array
	 */
	public function getTags()
	{
		return $this->tags;
	}
}