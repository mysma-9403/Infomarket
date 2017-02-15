<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Magazine;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class MagazineCategoryAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $magazines = array();
	
	/**
	 *
	 * @var array
	 */
	protected $categories = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->magazines = $this->getRequestArray($request, 'magazines');
		$this->categories = $this->getRequestArray($request, 'categories');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->magazines = array();
		$this->categories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'magazines', $this->magazines);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}
	
	/**
	 * Set magazines
	 *
	 * @param array $magazines
	 *
	 * @return MagazineCategoryAssignmentFilter
	 */
	public function setMagazines($magazines)
	{
		$this->magazines = $magazines;
	
		return $this;
	}
	
	/**
	 * Get magazines
	 *
	 * @return array
	 */
	public function getMagazines()
	{
		return $this->magazines;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return MagazineCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get magazine categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}