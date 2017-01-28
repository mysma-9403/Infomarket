<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\NewsletterBlockTemplateRepository;
use AppBundle\Repository\NewsletterPageRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockFilter extends SimpleEntityFilter {
	
	/**
	 * @var NewsletterPageRepository
	 */
	protected $newsletterPageRepository;
	
	/**
	 * @var NewsletterBlockTemplateRepository
	 */
	protected $newsletterBlockTemplateRepository;
	
	/**
	 * 
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(UserRepository $userRepository, 
			NewsletterPageRepository $newsletterPageRepository,
			NewsletterBlockTemplateRepository $newsletterBlockTemplateRepository) {
		
		parent::__construct($userRepository);
		
		$this->newsletterPageRepository = $newsletterPageRepository;
		$this->newsletterBlockTemplateRepository = $newsletterBlockTemplateRepository;
		
		$this->filterName = 'newsletter_block_filter_';
		
		$this->newsletterPages = array();
		$this->newsletterBlockTemplates = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$newsletterPages = $request->get($this->getFilterName() . 'newsletterPages', array());
		$this->newsletterPages = $this->newsletterPageRepository->findBy(array('id' => $newsletterPages));
		
		$newsletterBlockTemplates = $request->get($this->getFilterName() . 'newsletterBlockTemplates', array());
		$this->newsletterBlockTemplates = $this->newsletterBlockTemplateRepository->findBy(array('id' => $newsletterBlockTemplates));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->newsletterPages = array();
		$this->newsletterBlockTemplates = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->newsletterPages) {
			$values[$this->getFilterName() . 'newsletterPages'] = $this->getIdValues($this->newsletterPages);
		}
		
		if($this->newsletterBlockTemplates) {
			$values[$this->getFilterName() . 'newsletterBlockTemplates'] = $this->getIdValues($this->newsletterBlockTemplates);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->newsletterPages) {
			$expressions[] = $this->getEqualArrayExpression('e.newsletterPage', $this->newsletterPages);
		}
		
		if($this->newsletterBlockTemplates) {
			$expressions[] = $this->getEqualArrayExpression('e.newsletterBlockTemplate', $this->newsletterBlockTemplates);
		}
		
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterPages;
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterBlockTemplates;
	
	/**
	 * Set newsletterPages
	 *
	 * @param array $newsletterPages
	 *
	 * @return NewsletterBlockFilter
	 */
	public function setNewsletterPages($newsletterPages)
	{
		$this->newsletterPages = $newsletterPages;
	
		return $this;
	}
	
	/**
	 * Get newsletterPages
	 *
	 * @return array
	 */
	public function getNewsletterPages()
	{
		return $this->newsletterPages;
	}
	
	/**
	 * Set newsletterBlockTemplates
	 *
	 * @param array $newsletterBlockTemplates
	 *
	 * @return NewsletterBlockFilter
	 */
	public function setNewsletterBlockTemplates($newsletterBlockTemplates)
	{
		$this->newsletterBlockTemplates = $newsletterBlockTemplates;
	
		return $this;
	}
	
	/**
	 * Get newsletterBlockTemplates
	 *
	 * @return array
	 */
	public function getNewsletterBlockTemplates()
	{
		return $this->newsletterBlockTemplates;
	}
}