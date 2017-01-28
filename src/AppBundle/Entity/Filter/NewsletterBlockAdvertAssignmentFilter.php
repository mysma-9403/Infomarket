<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Advert;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Repository\AdvertRepository;
use AppBundle\Repository\NewsletterBlockAdvertAssignmentRepository;
use AppBundle\Repository\NewsletterBlockRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockAdvertAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param NewsletterBlockAdvertAssignmentRepository $newsletterBlockRepository
	 * @param AdvertRepository $advertRepository
	 */
	public function __construct(UserRepository $userRepository, NewsletterBlockRepository $newsletterBlockRepository, AdvertRepository $advertRepository) {
		parent::__construct($userRepository);
		
		$this->newsletterBlockRepository = $newsletterBlockRepository;
		$this->advertRepository = $advertRepository;
		
		$this->filterName = 'newsletter_block_advert_assignment_filter_';
		
		$this->orderBy = 'a.name ASC, nb.name';
	}
	
	/**
	 * @var NewsletterBlockAdvertAssignmentAdvertRepository
	 */
	protected $newsletterBlockRepository;
	
	/**
	 * @var AdvertRepository
	 */
	protected $advertRepository;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$newsletterBlocks = $request->get($this->getFilterName() . 'newsletterBlocks', array());
		$this->newsletterBlocks = $this->newsletterBlockRepository->findBy(array('id' => $newsletterBlocks));
		
		$adverts = $request->get($this->getFilterName() . 'adverts', array());
		$this->adverts = $this->advertRepository->findBy(array('id' => $adverts));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->newsletterBlocks = array();
		$this->adverts = array();
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
		
		if($this->adverts) {
			$values[$this->getFilterName() . 'adverts'] = $this->getIdValues($this->adverts);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->newsletterBlocks) {
			$expressions[] = $this->getEqualArrayExpression('e.newsletterBlock', $this->newsletterBlocks);
		}
		
		if($this->adverts) {
			$expressions[] = $this->getEqualArrayExpression('e.advert', $this->adverts);
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
		$expressions[] = Advert::class . ' a WITH e.advert = a.id';
	
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
	private $adverts;
	
	/**
	 * Set newsletterBlocks
	 *
	 * @param array $newsletterBlocks
	 *
	 * @return NewsletterBlockAdvertAssignmentFilter
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
	 * Set adverts
	 *
	 * @param array $adverts
	 *
	 * @return NewsletterBlockAdvertAssignmentFilter
	 */
	public function setAdverts($adverts)
	{
		$this->adverts = $adverts;
	
		return $this;
	}
	
	/**
	 * Get newsletterBlock adverts
	 *
	 * @return array
	 */
	public function getAdverts()
	{
		return $this->adverts;
	}
}