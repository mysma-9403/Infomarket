<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Advert;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class AdvertCategoryAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $adverts = array();
	
	/**
	 *
	 * @var array
	 */
	protected $categories = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->adverts = $this->getRequestArray($request, 'adverts');
		$this->categories = $this->getRequestArray($request, 'categories');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->adverts = array();
		$this->categories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'adverts', $this->adverts);
		$this->setRequestArray($values, 'categories', $this->categories);
		
		return $values;
	}
	
	/**
	 * Set adverts
	 *
	 * @param array $adverts
	 *
	 * @return AdvertCategoryAssignmentFilter
	 */
	public function setAdverts($adverts)
	{
		$this->adverts = $adverts;
	
		return $this;
	}
	
	/**
	 * Get adverts
	 *
	 * @return array
	 */
	public function getAdverts()
	{
		return $this->adverts;
	}
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return AdvertCategoryAssignmentFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get advert categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}