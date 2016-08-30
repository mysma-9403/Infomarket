<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class MagazineFilter extends SimpleEntityFilter {

	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = 'magazine_filter_';
		
		$this->featured = $this::ALL_VALUES;
		
		$this->orderBy = 'e.name ASC';
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
		
		$this->featured = $request->get($this->getFilterName() . 'featured', $this::ALL_VALUES);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
		
		$this->featured = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
		
		if($this->featured !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'featured'] = $this->featured;
		}
		
		return $values;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getWhereExpressions()
	 */
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
	
		if($this->featured !== SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.featured = ' . $this->featured;
		}
	
		return $expressions;
	}
	
	/**
	 *
	 * @var boolean
	 */
	private $featured;
	
	/**
	 * Set featured
	 *
	 * @param boolean $featured
	 *
	 * @return SimpleEntityFilter
	 */
	public function setFeatured($featured)
	{
		$this->featured = $featured;
	
		return $this;
	}
	
	/**
	 * Get featured
	 *
	 * @return boolean
	 */
	public function getFeatured()
	{
		return $this->featured;
	}
}