<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleArticleCategoryAssignmentFilter extends SimpleFilter {

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

	public function setArticles($articles) {
		$this->articles = $articles;
		
		return $this;
	}

	public function getArticles() {
		return $this->articles;
	}

	public function setArticleCategories($articleCategories) {
		$this->articleCategories = $articleCategories;
		
		return $this;
	}

	public function getArticleCategories() {
		return $this->articleCategories;
	}
}