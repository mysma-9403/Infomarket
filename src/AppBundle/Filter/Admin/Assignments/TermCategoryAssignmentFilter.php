<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Term;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class TermCategoryAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $terms = array();
	
	/**
	 *
	 * @var array
	 */
	protected $categories = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->terms = $this->getRequestArray($request, 'terms');
		$this->categories = $this->getRequestArray($request, 'categories');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->terms = array();
		$this->categories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'terms', $this->terms);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}
	
	/**
	 * Set terms
	 *
	 * @param array $terms
	 *
	 * @return TermCategoryAssignmentFilter
	 */
	public function setTerms($terms)
	{
		$this->terms = $terms;
	
		return $this;
	}
	
	/**
	 * Get terms
	 *
	 * @return array
	 */
	public function getTerms()
	{
		return $this->terms;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return TermCategoryAssignmentFilter
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
}