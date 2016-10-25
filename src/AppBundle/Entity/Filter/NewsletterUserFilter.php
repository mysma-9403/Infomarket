<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = 'newsletter_user_filter_';
		
		$this->subscribed = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
		
		$this->subscribed = $request->get($this->getFilterName() . 'subscribed', $this::ALL_VALUES);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
		
		$this->subscribed = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
		
		if($this->subscribed !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'subscribed'] = $this->subscribed;
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->subscribed !== SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.subscribed = ' . $this->subscribed;
		}
		
		return $expressions;
	}
	
	/**
	 * @var boolean
	 */
	protected $subscribed;
	
	/**
	 * Set subscribed
	 *
	 * @param boolean $subscribed
	 *
	 * @return SimpleEntityFilter
	 */
	public function setSubscribed($subscribed)
	{
		$this->subscribed = $subscribed;
	
		return $this;
	}
	
	/**
	 * Is subscribed
	 *
	 * @return boolean
	 */
	public function isSubscribed()
	{
		return $this->subscribed;
	}
}