<?php

namespace AppBundle\Filter\Admin\Main;

use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;


class AdvertFilter extends SimpleEntityFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $categories;
	
	/**
	 *
	 * @var array
	 */
	protected $locations;
	
	/**
	 * @var string
	 */
	protected $link;
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->categories = $this->getRequestArray($request, 'categories');
		$this->locations = $this->getRequestArray($request, 'locations');
		
		$this->link = $this->getRequestValue($request, 'link');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->categories = array();
		$this->locations = array();
		
		$this->link = null;
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'categories', $this->categories);
		$this->setRequestArray($values, 'locations', $this->locations);
		
		$this->setRequestValue($values, 'link', $this->link);
		
		return $values;
	}
	
	/**
	 * Set article categories
	 *
	 * @param array $articleCategories
	 *
	 * @return AdvertFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get article categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set article categories
	 *
	 * @param array $articleCategories
	 *
	 * @return AdvertFilter
	 */
	public function setLocations($locations)
	{
		$this->locations = $locations;
	
		return $this;
	}
	
	/**
	 * Get article categories
	 *
	 * @return array
	 */
	public function getLocations()
	{
		return $this->locations;
	}
	
	/**
	 * Set link
	 *
	 * @param string $link
	 *
	 * @return Advert
	 */
	public function setLink($link)
	{
		$this->link = $link;
	
		return $this;
	}
	
	/**
	 * Get link
	 *
	 * @return string
	 */
	public function getLink()
	{
		return $this->link;
	}
}