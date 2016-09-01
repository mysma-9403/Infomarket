<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\NewsletterPageTemplateRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterPageFilter extends SimpleEntityFilter {
	
	/**
	 * @var NewsletterPageTemplateRepository
	 */
	protected $newsletterPageTemplateRepository;
	
	/**
	 * 
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(UserRepository $userRepository,
			NewsletterPageTemplateRepository $newsletterPageTemplateRepository) {
		
		parent::__construct($userRepository);
		
		$this->newsletterPageTemplateRepository = $newsletterPageTemplateRepository;
		
		$this->filterName = 'newsletter_page_filter_';
		
		$this->newsletterPageTemplates = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$newsletterPageTemplates = $request->get($this->getFilterName() . 'newsletterPageTemplates', array());
		$this->newsletterPageTemplates = $this->newsletterPageTemplateRepository->findBy(array('id' => $newsletterPageTemplates));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->newsletterPageTemplates = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->newsletterPageTemplates) {
			$values[$this->getFilterName() . 'newsletterPageTemplates'] = $this->getIdValues($this->newsletterPageTemplates);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->newsletterPageTemplates) {
			$expressions[] = $this->getEqualArrayExpression('e.newsletterPageTemplate', $this->newsletterPageTemplates);
		}
		
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterPageTemplates;
	
	/**
	 * Set newsletterPageTemplates
	 *
	 * @param array $newsletterPageTemplates
	 *
	 * @return NewsletterPageFilter
	 */
	public function setNewsletterPageTemplates($newsletterPageTemplates)
	{
		$this->newsletterPageTemplates = $newsletterPageTemplates;
	
		return $this;
	}
	
	/**
	 * Get newsletterPageTemplates
	 *
	 * @return array
	 */
	public function getNewsletterPageTemplates()
	{
		return $this->newsletterPageTemplates;
	}
}