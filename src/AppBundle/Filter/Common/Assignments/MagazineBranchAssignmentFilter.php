<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleEntityFilter;
use Symfony\Component\HttpFoundation\Request;

class MagazineBranchAssignmentFilter extends SimpleEntityFilter {

	/**
	 *
	 * @var array
	 */
	protected $magazines = array ();

	/**
	 *
	 * @var array
	 */
	protected $branches = array ();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->magazines = $this->getRequestArray($request, 'magazines');
		$this->branches = $this->getRequestArray($request, 'branches');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->magazines = array ();
		$this->branches = array ();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'magazines', $this->magazines);
		$this->setRequestArray($values, 'branches', $this->branches);
		
		return $values;
	}

	public function setMagazines($magazines) {
		$this->magazines = $magazines;
		
		return $this;
	}

	public function getMagazines() {
		return $this->magazines;
	}

	public function setBranches($branches) {
		$this->branches = $branches;
		
		return $this;
	}

	public function getBranches() {
		return $this->branches;
	}
}