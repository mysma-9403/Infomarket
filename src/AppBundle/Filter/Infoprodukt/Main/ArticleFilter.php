<?php

namespace AppBundle\Filter\Infoprodukt\Main;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Infomarket\Base\CategoriesDependentFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleFilter extends CategoriesDependentFilter {

	/**
	 *
	 * @var array
	 */
	protected $articleCategories;

	public function __construct() {
		$this->filterName = 'article_filter_';
	}

	public function initRequestValues(Request $request) {
		$this->articleCategories = $this->getRequestArray($request, 'article_categories');
	}

	public function clearRequestValues() {
		$this->articleCategories = array();
	}

	public function getRequestValues() {
		$values = array();
		
		$this->setRequestArray($values, 'article_categories', $this->articleCategories);
		
		return $values;
	}

	public function getArticleCategories() {
		return $this->articleCategories;
	}

	public function setArticleCategories($articleCategories) {
		$this->articleCategories = $articleCategories;
		return $this;
	}
}