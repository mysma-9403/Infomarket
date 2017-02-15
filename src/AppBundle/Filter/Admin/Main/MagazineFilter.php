<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class MagazineFilter extends SimpleEntityFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $parents = array();
	
	/**
	 *
	 * @var array
	 */
	protected $branches = array();
	
	/**
	 *
	 * @var array
	 */
	protected $categories = array();
	
	/**
	 * 
	 * @var integer
	 */
	protected $featured = self::ALL_VALUES;
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->parents = $this->getRequestArray($request, 'parents');
		$this->branches = $this->getRequestArray($request, 'branches');
		$this->categories = $this->getRequestArray($request, 'categories');
		
		$this->featured = $this->getRequestBool($request, 'featured');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->parents = array();
		$this->branches = array();
		$this->categories = array();
		
		$this->featured = self::ALL_VALUES;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'parents', $this->parents);
		$this->setRequestArray($values, 'branches', $this->branches);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		$this->setRequestBool($values, 'featured', $this->featured);
		
		return $values;
	}
	
	/**
	 * Set parents
	 *
	 * @param array $parents
	 *
	 * @return MagazineFilter
	 */
	public function setParents($parents)
	{
		$this->parents = $parents;
	
		return $this;
	}
	
	/**
	 * Get term parents
	 *
	 * @return array
	 */
	public function getParents()
	{
		return $this->parents;
	}
	
	/**
	 * Set branches
	 *
	 * @param array $branches
	 *
	 * @return MagazineFilter
	 */
	public function setBranches($branches)
	{
		$this->branches = $branches;
	
		return $this;
	}
	
	/**
	 * Get term branches
	 *
	 * @return array
	 */
	public function getBranches()
	{
		return $this->branches;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return MagazineFilter
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
	 * Set featured
	 *
	 * @param array $featured
	 *
	 * @return MagazineFilter
	 */
	public function setFeatured($featured)
	{
		$this->featured = $featured;
	
		return $this;
	}
	
	/**
	 * Get term featured
	 *
	 * @return array
	 */
	public function getFeatured()
	{
		return $this->featured;
	}
}