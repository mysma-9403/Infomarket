<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Filter\Base\ImageEntityFilter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class ArticleCategoryFilter extends ImageEntityFilter {
	
	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = 'article_category_filter_';
		
		$this->featured = $this::ALL_VALUES;
		$this->infomarket = $this::ALL_VALUES;
		$this->infoprodukt = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$this->featured = $request->get($this->getFilterName() . 'featured', $this::ALL_VALUES);
		$this->infomarket = $request->get($this->getFilterName() . 'infomarket', $this::ALL_VALUES);
		$this->infoprodukt = $request->get($this->getFilterName() . 'infoprodukt', $this::ALL_VALUES);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->featured = $this::ALL_VALUES;
		$this->infomarket = $this::ALL_VALUES;
		$this->infoprodukt = $this::ALL_VALUES;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->featured != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'featured'] = $this->featured;
		}
		
		if($this->infomarket != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'infomarket'] = $this->infomarket;
		}
		
		if($this->infoprodukt != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'infoprodukt'] = $this->infoprodukt;
		}
	
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->featured != $this::ALL_VALUES) {
			$expressions[] = 'e.featured = ' . $this->featured;
		}
		
		if($this->infomarket != $this::ALL_VALUES) {
			$expressions[] = 'e.infomarket = ' . $this->infomarket;
		}
		
		if($this->infoprodukt != $this::ALL_VALUES) {
			$expressions[] = 'e.infoprodukt = ' . $this->infoprodukt;
		}
		
		return $expressions;
	}
	
	/**
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
	 * Is featured
	 *
	 * @return boolean
	 */
	public function isFeatured()
	{
		return $this->featured;
	}
}