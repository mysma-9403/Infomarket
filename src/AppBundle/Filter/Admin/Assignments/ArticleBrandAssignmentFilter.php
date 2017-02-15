<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleBrandAssignmentFilter extends AuditFilter {
	
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
	
	/**
	 * Set articles
	 *
	 * @param array $articles
	 *
	 * @return ArticleBrandAssignmentFilter
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
	 * Set brands
	 *
	 * @param array $brands
	 *
	 * @return ArticleBrandAssignmentFilter
	 */
	public function setBrands($brands)
	{
		$this->brands = $brands;
	
		return $this;
	}
	
	/**
	 * Get article brands
	 *
	 * @return array
	 */
	public function getBrands()
	{
		return $this->brands;
	}
}