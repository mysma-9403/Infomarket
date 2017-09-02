<?php

namespace AppBundle\Filter\Common\Base;

use AppBundle\Filter\Base\Filter;
use Symfony\Component\HttpFoundation\Request;

class BaseFilter extends Filter {

	/**
	 *
	 * @var array
	 */
	protected $selected = array ();
	
	// TODO wgl tutaj nie pasuje!! powinno byc gdzie indziej!! :(
	public function initRequestValues(Request $request) {
		$this->selected = $this->getRequestArray($request, 'selected');
	}

	public function getRequestValues() {
		$values = array ();
		
		$this->setRequestArray($values, 'selected', $this->selected);
		
		return $values;
	}

	public function setSelected($selected) {
		$this->selected = $selected;
		
		return $this;
	}

	public function addSelected($selected) {
		$this->selected[] = $selected;
		
		return $this;
	}

	public function getSelected() {
		return $this->selected;
	}

	public function clearSelected() {
		$this->selected = array ();
		
		return $this;
	}
}