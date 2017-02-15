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
	
	public function __construct() {
		$this->filterName = 'article_filter_';
	}
	
	/**
	 *
	 * @param Request $request
	 */
	public function initRequestValues(Request $request) { 
		$this->articleCategories = $this->getRequestArray($request, 'article_categories');
		$this->categories = $this->getRequestArray($request, 'categories');
	}
	
	/**
	 *
	 */
	public function clearRequestValues() { 
		$this->articleCategories = array();
		$this->categories = array();
	}
	
	/**
	 * @return array
	 */
	public function getRequestValues() {
		$values = array();
		
		$this->setRequestArray($values, 'article_categories', $this->articleCategories);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
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