<?php

namespace AppBundle\Filter\Common\Main;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var string
	 */
	protected $name = null;

	/**
	 *
	 * @var string
	 */
	protected $subname = null;

	/**
	 *
	 * @var integer
	 */
	protected $infomarket = self::ALL_VALUES;

	/**
	 *
	 * @var integer
	 */
	protected $infoprodukt = self::ALL_VALUES;

	/**
	 *
	 * @var integer
	 */
	protected $featured = self::ALL_VALUES;

	/**
	 *
	 * @var array
	 */
	protected $brands = array ();

	/**
	 *
	 * @var array
	 */
	protected $categories = array ();

	/**
	 *
	 * @var array
	 */
	protected $articleCategories = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->name = $this->getRequestString($request, 'name');
		$this->subname = $this->getRequestValue($request, 'subname');
		
		$this->infomarket = $this->getRequestBool($request, 'infomarket');
		$this->infoprodukt = $this->getRequestBool($request, 'infoprodukt');
		$this->featured = $this->getRequestBool($request, 'featured');
		
		$this->brands = $this->getRequestArray($request, 'brands');
		$this->categories = $this->getRequestArray($request, 'categories');
		$this->articleCategories = $this->getRequestArray($request, 'article_categories');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->brands = array ();
		$this->categories = array ();
		$this->articleCategories = array ();
		
		$this->name = null;
		$this->subname = null;
		
		$this->infomarket = self::ALL_VALUES;
		$this->infoprodukt = self::ALL_VALUES;
		$this->featured = self::ALL_VALUES;
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestString($values, 'name', $this->name);
		$this->setRequestValue($values, 'subname', $this->subname);
		
		$this->setRequestBool($values, 'infomarket', $this->infomarket);
		$this->setRequestBool($values, 'infoprodukt', $this->infoprodukt);
		$this->setRequestBool($values, 'featured', $this->featured);
		
		$this->setRequestArray($values, 'brands', $this->brands);
		$this->setRequestArray($values, 'categories', $this->categories);
		$this->setRequestArray($values, 'article_categories', $this->articleCategories);
		
		return $values;
	}

	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setSubname($subname) {
		$this->subname = $subname;
		
		return $this;
	}

	public function getSubname() {
		return $this->subname;
	}

	public function setInfomarket($infomarket) {
		$this->infomarket = $infomarket;
		
		return $this;
	}

	public function getInfomarket() {
		return $this->infomarket;
	}

	public function setInfoprodukt($infoprodukt) {
		$this->infoprodukt = $infoprodukt;
		
		return $this;
	}

	public function getInfoprodukt() {
		return $this->infoprodukt;
	}

	public function setFeatured($featured) {
		$this->featured = $featured;
		
		return $this;
	}

	public function getFeatured() {
		return $this->featured;
	}

	public function setBrands($brands) {
		$this->brands = $brands;
		
		return $this;
	}

	public function getBrands() {
		return $this->brands;
	}

	public function setCategories($categories) {
		$this->categories = $categories;
		
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function setArticleCategories($articleCategories) {
		$this->articleCategories = $articleCategories;
		
		return $this;
	}

	public function getArticleCategories() {
		return $this->articleCategories;
	}
}