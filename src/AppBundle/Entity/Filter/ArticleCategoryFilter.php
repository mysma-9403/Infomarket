<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Filter\Base\ImageEntityFilter;

class ArticleCategoryFilter extends ImageEntityFilter {
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->featured) {
			$expressions[] = 'e.featured = ' . $this->featured;
		}
		
		return $expressions;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getOrderByExpression() {
		return ' ORDER BY e.name ASC ';
	}
	
	/**
	 * @var boolean
	 */
	private $featured;
	
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
}