<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\FeaturedEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleFilter extends FeaturedEntityFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $brands = array();
	
	/**
	 *
	 * @var array
	 */
	protected $categories = array();
	
	/**
	 *
	 * @var array
	 */
	protected $articleCategories = array();
	
	/**
	 *
	 * @var string
	 */
	protected $subname = null;
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->brands = $this->getRequestArray($request, 'brands');
		$this->categories = $this->getRequestArray($request, 'categories');
		$this->articleCategories = $this->getRequestArray($request, 'article_categories');
		
		$this->subname = $this->getRequestValue($request, 'subname');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->brands = array();
		$this->categories = array();
		$this->articleCategories = array();
		
		$this->subname = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'brands', $this->brands);
		$this->setRequestArray($values, 'categories', $this->categories);
		$this->setRequestArray($values, 'article_categories', $this->articleCategories);
		
		$this->setRequestValue($values, 'subname', $this->subname);
		
		return $values;
	}
	
	/**
	 * Set brands
	 *
	 * @param array $brands
	 *
	 * @return ArticleFilter
	 */
	public function setBrands($brands)
	{
		$this->brands = $brands;
	
		return $this;
	}
	
	/**
	 * Get term brands
	 *
	 * @return array
	 */
	public function getBrands()
	{
		return $this->brands;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return ArticleFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get term categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set articleCategories
	 *
	 * @param array $articleCategories
	 *
	 * @return ArticleFilter
	 */
	public function setArticleCategories($articleCategories)
	{
		$this->articleCategories = $articleCategories;
	
		return $this;
	}
	
	/**
	 * Get term articleCategories
	 *
	 * @return array
	 */
	public function getArticleCategories()
	{
		return $this->articleCategories;
	}
	
	/**
	 * Set subname
	 *
	 * @param array $subname
	 *
	 * @return ArticleFilter
	 */
	public function setSubname($subname)
	{
		$this->subname = $subname;
	
		return $this;
	}
	
	/**
	 * Get term subname
	 *
	 * @return array
	 */
	public function getSubname()
	{
		return $this->subname;
	}
}