<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Magazine;
use AppBundle\Repository\BranchRepository;
use AppBundle\Repository\MagazineRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class MagazineBranchAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param UserRepository $userRepository
	 * @param MagazineRepository $magazineRepository
	 * @param BranchRepository $branchRepository
	 */
	public function __construct(
			UserRepository $userRepository, 
			MagazineRepository $magazineRepository, 
			BranchRepository $branchRepository) {
		
		parent::__construct($userRepository);
		
		$this->magazineRepository = $magazineRepository;
		$this->branchRepository = $branchRepository;
		
		$this->filterName = 'magazine_branch_assignment_filter_';
		
		$this->orderBy = 'b.name ASC, m.date DESC, m.name ASC';
	}
	
	/**
	 * @var MagazineBranchAssignmentBranchRepository
	 */
	protected $magazineRepository;
	
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
	
		$magazines = $request->get($this->getFilterName() . 'magazines', array());
		$this->magazines = $this->magazineRepository->findBy(array('id' => $magazines));
		
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
	
		$this->magazines = array();
		$this->branches = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->magazines) {
			$values[$this->getFilterName() . 'magazines'] = $this->getIdValues($this->magazines);
		}
		
		if($this->branches) {
			$values[$this->getFilterName() . 'branches'] = $this->getIdValues($this->branches);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->magazines) {
			$expressions[] = $this->getEqualArrayExpression('e.magazine', $this->magazines);
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
		
		$expressions[] = Magazine::class . ' m WITH e.magazine = m.id';
		$expressions[] = Branch::class . ' b WITH e.branch = b.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $magazines;
	
	/**
	 *
	 * @var array
	 */
	private $branches;
	
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