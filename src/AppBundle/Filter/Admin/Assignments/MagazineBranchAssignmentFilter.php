<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\Magazine;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class MagazineBranchAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $magazines = array();
	
	/**
	 *
	 * @var array
	 */
	protected $branches = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->magazines = $this->getRequestArray($request, 'magazines');
		$this->branches = $this->getRequestArray($request, 'branches');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->magazines = array();
		$this->branches = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'magazines', $this->magazines);
		$this->setRequestArray($values, 'branches', $this->branches);
		
		return $values;
	}
	
	/**
	 * Set magazines
	 *
	 * @param array $magazines
	 *
	 * @return MagazineBranchAssignmentFilter
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
	 * Set branches
	 *
	 * @param array $branches
	 *
	 * @return MagazineBranchAssignmentFilter
	 */
	public function setBranches($branches)
	{
		$this->branches = $branches;
	
		return $this;
	}
	
	/**
	 * Get magazine branches
	 *
	 * @return array
	 */
	public function getBranches()
	{
		return $this->branches;
	}
}