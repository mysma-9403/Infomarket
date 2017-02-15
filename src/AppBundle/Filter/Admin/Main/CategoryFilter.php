<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class CategoryFilter extends SimpleEntityFilter {
	
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
	 * @var integer
	 */
	protected $featured = self::ALL_VALUES;
	
	/**
	 *
	 * @var integer
	 */
	protected $preleaf = self::ALL_VALUES;
	
	/**
	 *
	 * @var string
	 */
	protected $subname = null;
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->parents = $this->getRequestArray($request, 'parents');
		$this->branches = $this->getRequestArray($request, 'branches');
		
		$this->featured = $this->getRequestBool($request, 'featured');
		$this->preleaf = $this->getRequestBool($request, 'preleaf');
		
		$this->subname = $this->getRequestValue($request, 'subname');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->parents = array();
		$this->branches = array();
		
		$this->featured = self::ALL_VALUES;
		$this->preleaf = self::ALL_VALUES;
		
		$this->subname = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'parents', $this->parents);
		$this->setRequestArray($values, 'branches', $this->branches);
		
		$this->setRequestBool($values, 'featured', $this->featured);
		$this->setRequestBool($values, 'preleaf', $this->preleaf);
		
		$this->setRequestValue($values, 'subname', $this->subname);
		
		return $values;
	}
	
	/**
	 * Set parents
	 *
	 * @param array $parents
	 *
	 * @return CategoryFilter
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
	 * @return CategoryFilter
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
	 * Set featured
	 *
	 * @param array $featured
	 *
	 * @return CategoryFilter
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
	
	/**
	 * Set preleaf
	 *
	 * @param array $preleaf
	 *
	 * @return CategoryFilter
	 */
	public function setPreleaf($preleaf)
	{
		$this->preleaf = $preleaf;
	
		return $this;
	}
	
	/**
	 * Get term preleaf
	 *
	 * @return array
	 */
	public function getPreleaf()
	{
		return $this->preleaf;
	}
	
	/**
	 * Set subname
	 *
	 * @param array $subname
	 *
	 * @return CategoryFilter
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