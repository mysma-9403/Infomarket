<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleBrandAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $articles = array();

	/**
	 *
	 * @var array
	 */
	protected $brands = array();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->articles = $this->getRequestArray($request, 'articles');
		$this->brands = $this->getRequestArray($request, 'brands');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->articles = array();
		$this->brands = array();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'articles', $this->articles);
		$this->setRequestArray($values, 'brands', $this->brands);
		
		return $values;
	}

	public function setArticles($articles) {
		$this->articles = $articles;
		
		return $this;
	}

	public function getArticles() {
		return $this->articles;
	}

	public function setBrands($brands) {
		$this->brands = $brands;
		
		return $this;
	}

	public function getBrands() {
		return $this->brands;
	}
}