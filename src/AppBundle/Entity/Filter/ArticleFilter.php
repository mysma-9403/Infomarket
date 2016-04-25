<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;

class ArticleFilter extends SimpleEntityFilter {
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->articleCategories) {
			$expressions[] = $this->getEqualArrayExpression('e.articleCategory', $this->articleCategories);
		}
		
		if($this->featured) {
			$expressions[] = 'e.featured = ' . $this->featured;
		}
		
		if($this->main === SimpleEntityFilter::TRUE_VALUES) {
			$expressions[] = 'e.parent IS NULL';
		} else {
			if($this->main === SimpleEntityFilter::FALSE_VALUES) {
				$expressions[] = 'e.parent IS NOT NULL';
			}
			if($this->parents) {
				$expressions[] = $this->getEqualArrayExpression('e.parent', $this->parents);
			}
		}
		
		return $expressions;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return ' ORDER BY e.orderNumber ASC, e.name ASC ';
	}
	
	/**
	 *
	 * @var array
	 */
	private $articleCategories;
	
	/**
	 * @var array
	 */
	private $parents;
	
	/**
	 * @var boolean
	 */
	private $featured;
	
	/**
	 * @var boolean
	 */
	private $main;
	
	/**
	 * Set article categories
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
	 * Get article categories
	 *
	 * @return array
	 */
	public function getArticleCategories()
	{
		return $this->articleCategories;
	}
	
	/**
	 * Set article categories
	 *
	 * @param array $articleCategories
	 *
	 * @return ArticleFilter
	 */
	public function setParents($parents)
	{
		$this->parents = $parents;
	
		return $this;
	}
	
	/**
	 * Get article categories
	 *
	 * @return array
	 */
	public function getParents()
	{
		return $this->parents;
	}
	
	/**
	 * Set featured
	 *
	 * @param boolean $featured
	 *
	 * @return SimpleEntityFilter
	 */
	public function setFeatured($featured)
	{
		$this->featured = $featured;
	
		return $this;
	}
	
	/**
	 * Is featured
	 *
	 * @return boolean
	 */
	public function isFeatured()
	{
		return $this->featured;
	}
	
	/**
	 * Set main
	 *
	 * @param boolean $main
	 *
	 * @return SimpleEntityFilter
	 */
	public function setMain($main)
	{
		$this->main = $main;
	
		return $this;
	}
	
	/**
	 * Is main
	 *
	 * @return boolean
	 */
	public function isMain()
	{
		return $this->main;
	}
}