<?php

namespace AppBundle\Filter\Admin\Base;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class AdminFilter extends Filter {
	
	/**
	 * @var array
	 */
	protected $selected = array(); //TODO wgl tutaj nie pasuje!! powinno byc gdzie indziej!! :(
	
	
	
	public function initRequestValues(Request $request) {
		$this->selected = $this->getRequestArray($request, 'selected');
	}
	
	public function getRequestValues() {
		$values = array();
		
		$this->setRequestArray($values, 'selected', $this->selected);

		return $values;
	}
	
	public function setSelected($selected)
	{
		$this->selected = $selected;
	
		return $this;
	}
	
	/**
	 * Add id of selected entry
	 *
	 * @param integer $selected
	 *
	 * @return SimpleEntityFilter
	 */
	public function addSelected($selected)
	{
		$this->selected[] = $selected;
	
		return $this;
	}
	
	/**
	 * Get selected ids
	 *
	 * @return array
	 */
	public function getSelected()
	{
		return $this->selected;
	}
	
	/**
	 * Clear selected ids
	 *
	 * @return SimpleEntityFilter
	 */
	public function clearSelected()
	{
		$this->selected = array();
	
		return $this;
	}
}