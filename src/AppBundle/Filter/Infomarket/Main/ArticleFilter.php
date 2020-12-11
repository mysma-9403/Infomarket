<?php

namespace AppBundle\Filter\Infomarket\Main;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Infomarket\Base\CategoriesDependentFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleFilter extends CategoriesDependentFilter {

	/**
	 *
	 * @var array
	 */
	protected $articleCategories;

	/**
	 *
	 * @var array
	 */
	protected $categories;

	/**
	 *
	 * @var array
	 */
	protected $contextArticleCategories = array();

	public function __construct() {
		$this->filterName = 'article_filter_';
	}

	public function initContextParams(array $contextParams) {
		parent::initContextParams($contextParams);
		
		$this->contextArticleCategories = $contextParams['articleCategories'];
	}

	public function initRequestValues(Request $request) {
		$this->articleCategories = $this->getRequestArray($request, 'article_categories');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		$this->articleCategories = array();
		$this->categories = array();
	}

	public function getRequestValues() {
		$values = array();
		
		$this->setRequestArray($values, 'article_categories', $this->articleCategories);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}

	public function getContextArticleCategories() {
		return $this->contextArticleCategories;
	}

	public function getArticleCategories() {
		return $this->articleCategories;
	}

	public function setArticleCategories($articleCategories) {
		$this->articleCategories = $articleCategories;
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		return $this;
	}
}