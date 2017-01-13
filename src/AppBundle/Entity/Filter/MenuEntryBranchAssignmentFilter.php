<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Branch;
use AppBundle\Entity\MenuEntry;
use AppBundle\Repository\BranchRepository;
use AppBundle\Repository\MenuEntryRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class MenuEntryBranchAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param UserRepository $userRepository
	 * @param MenuEntryRepository $menuEntryRepository
	 * @param BranchRepository $branchRepository
	 */
	public function __construct(
			UserRepository $userRepository, 
			MenuEntryRepository $menuEntryRepository, 
			BranchRepository $branchRepository) {
		
		parent::__construct($userRepository);
		
		$this->menuEntryRepository = $menuEntryRepository;
		$this->branchRepository = $branchRepository;
		
		$this->filterName = 'menuEntry_branch_assignment_filter_';
		
		$this->orderBy = 'b.name ASC, me.name ASC';
	}
	
	/**
	 * @var MenuEntryBranchAssignmentBranchRepository
	 */
	protected $menuEntryRepository;
	
	/**
	 * @var BranchRepository
	 */
	protected $branchRepository;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$menuEntries = $request->get($this->getFilterName() . 'menuEntries', array());
		$this->menuEntries = $this->menuEntryRepository->findBy(array('id' => $menuEntries));
		
		$branches = $request->get($this->getFilterName() . 'branches', array());
		$this->branches = $this->branchRepository->findBy(array('id' => $branches));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->menuEntries = array();
		$this->branches = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->menuEntries) {
			$values[$this->getFilterName() . 'menuEntries'] = $this->getIdValues($this->menuEntries);
		}
		
		if($this->branches) {
			$values[$this->getFilterName() . 'branches'] = $this->getIdValues($this->branches);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->menuEntries) {
			$expressions[] = $this->getEqualArrayExpression('e.menuEntry', $this->menuEntries);
		}
		
		if($this->branches) {
			$expressions[] = $this->getEqualArrayExpression('e.branch', $this->branches);
		}
		
		return $expressions;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getJoinExpressions()
	 */
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
		
		$expressions[] = MenuEntry::class . ' me WITH e.menuEntry = me.id';
		$expressions[] = Branch::class . ' b WITH e.branch = b.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $menuEntries;
	
	/**
	 *
	 * @var array
	 */
	private $branches;
	
	/**
	 * Set menuEntries
	 *
	 * @param array $menuEntries
	 *
	 * @return MenuEntryBranchAssignmentFilter
	 */
	public function setMenuEntries($menuEntries)
	{
		$this->menuEntries = $menuEntries;
	
		return $this;
	}
	
	/**
	 * Get menuEntries
	 *
	 * @return array
	 */
	public function getMenuEntries()
	{
		return $this->menuEntries;
	}
	
	/**
	 * Set branches
	 *
	 * @param array $branches
	 *
	 * @return MenuEntryBranchAssignmentFilter
	 */
	public function setBranches($branches)
	{
		$this->branches = $branches;
	
		return $this;
	}
	
	/**
	 * Get menuEntry branches
	 *
	 * @return array
	 */
	public function getBranches()
	{
		return $this->branches;
	}
}