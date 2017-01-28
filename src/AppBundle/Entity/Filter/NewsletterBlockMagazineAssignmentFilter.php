<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Repository\MagazineRepository;
use AppBundle\Repository\NewsletterBlockMagazineAssignmentRepository;
use AppBundle\Repository\NewsletterBlockRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockMagazineAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param NewsletterBlockMagazineAssignmentRepository $newsletterBlockRepository
	 * @param MagazineRepository $magazineRepository
	 */
	public function __construct(UserRepository $userRepository, NewsletterBlockRepository $newsletterBlockRepository, MagazineRepository $magazineRepository) {
		parent::__construct($userRepository);
		
		$this->newsletterBlockRepository = $newsletterBlockRepository;
		$this->magazineRepository = $magazineRepository;
		
		$this->filterName = 'newsletter_block_magazine_assignment_filter_';
		
		$this->orderBy = 'm.name ASC, nb.name';
	}
	
	/**
	 * @var NewsletterBlockMagazineAssignmentMagazineRepository
	 */
	protected $newsletterBlockRepository;
	
	/**
	 * @var MagazineRepository
	 */
	protected $magazineRepository;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$newsletterBlocks = $request->get($this->getFilterName() . 'newsletterBlocks', array());
		$this->newsletterBlocks = $this->newsletterBlockRepository->findBy(array('id' => $newsletterBlocks));
		
		$magazines = $request->get($this->getFilterName() . 'magazines', array());
		$this->magazines = $this->magazineRepository->findBy(array('id' => $magazines));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->newsletterBlocks = array();
		$this->magazines = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->newsletterBlocks) {
			$values[$this->getFilterName() . 'newsletter_blocks'] = $this->getIdValues($this->newsletterBlocks);
		}
		
		if($this->magazines) {
			$values[$this->getFilterName() . 'magazines'] = $this->getIdValues($this->magazines);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->newsletterBlocks) {
			$expressions[] = $this->getEqualArrayExpression('e.newsletterBlock', $this->newsletterBlocks);
		}
		
		if($this->magazines) {
			$expressions[] = $this->getEqualArrayExpression('m.magazine', $this->magazines);
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
		
		$expressions[] = NewsletterBlock::class . ' nb WITH e.newsletterBlock = nb.id';
		$expressions[] = Magazine::class . ' m WITH e.magazine = m.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $newsletterBlocks;
	
	/**
	 *
	 * @var array
	 */
	private $magazines;
	
	/**
	 * Set newsletterBlocks
	 *
	 * @param array $newsletterBlocks
	 *
	 * @return NewsletterBlockMagazineAssignmentFilter
	 */
	public function setNewsletterBlocks($newsletterBlocks)
	{
		$this->newsletterBlocks = $newsletterBlocks;
	
		return $this;
	}
	
	/**
	 * Get newsletterBlocks
	 *
	 * @return array
	 */
	public function getNewsletterBlocks()
	{
		return $this->newsletterBlocks;
	}
	
	/**
	 * Set magazines
	 *
	 * @param array $magazines
	 *
	 * @return NewsletterBlockMagazineAssignmentFilter
	 */
	public function setMagazines($magazines)
	{
		$this->magazines = $magazines;
	
		return $this;
	}
	
	/**
	 * Get newsletterBlock magazines
	 *
	 * @return array
	 */
	public function getMagazines()
	{
		return $this->magazines;
	}
}