<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleCategoryAssignmentFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var array
	 */
	protected $articles = array ();

	/**
	 *
	 * @var array
	 */
	protected $categories = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->articles = $this->getRequestArray($request, 'articles');
		$this->categories = $this->getRequestArray($request, 'categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->articles = array ();
		$this->categories = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'articles', $this->articles);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}

	public function setArticles($articles) {
		$this->articles = $articles;
		
		return $this;
	}

	public function getArticles() {
		return $this->articles;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}
}