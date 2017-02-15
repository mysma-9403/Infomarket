<?php

namespace AppBundle\Entity\Filter\Base;

use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class SimpleEntityFilter extends BaseEntityFilter {
	
	/**
	 * 
	 */
	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = "simple_filter_";
		
		$this->orderBy = 'e.name ASC';
		
		$this->addNameDecorators = false;
		
		$this->infomarket = $this::ALL_VALUES;
		$this->infoprodukt = $this::ALL_VALUES;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) { 
		$this->name = $request->get($this->getFilterName() . 'name', null);
		
		$this->infomarket = $request->get($this->getFilterName() . 'infomarket', $this::ALL_VALUES);
		$this->infoprodukt = $request->get($this->getFilterName() . 'infoprodukt', $this::ALL_VALUES);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() { 
		$this->name = null;
		
		$this->infomarket = $this::ALL_VALUES;
		$this->infoprodukt = $this::ALL_VALUES;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
		
		$values[$this->getFilterName() . 'name'] = $this->name;
		
		if($this->infomarket != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'infomarket'] = $this->infomarket;
		}
		if($this->infoprodukt != $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'infoprodukt'] = $this->infoprodukt;
		}
		
		return $values;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getExpressions()
	 */
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->name) {
			$expressions[] = $this->getStringsExpression('e.name', $this->name, $this->addNameDecorators);
		}
		
		if($this->infomarket != SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.infomarket = ' . $this->infomarket;
		}
		if($this->infoprodukt != SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.infoprodukt = ' . $this->infoprodukt;
		}
		
		return $expressions;
	}
	
	/**
	 * 
	 * @var bool
	 */
	protected $addNameDecorators;
	
	/**
	 * Set addNameDecorators
	 *
	 * @param bool $addNameDecorators
	 *
	 * @return SimpleEntityFilter
	 */
	public function setAddNameDecorators($addNameDecorators)
	{
		$this->addNameDecorators= $addNameDecorators;
	
		return $this;
	}
	
	/**
	 * Get addNameDecorators
	 *
	 * @return bool
	 */
	public function getAddNameDecorators()
	{
		return $this->addNameDecorators;
	}
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var integer
	 */
	protected $infomarket;
	
	/**
	 * @var integer
	 */
	protected $infoprodukt;
	
	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return SimpleEntityFilter
	 */
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Set infomarket
	 *
	 * @param integer $infomarket
	 *
	 * @return SimpleEntityFilter
	 */
	public function setInfomarket($infomarket)
	{
		$this->infomarket = $infomarket;
	
		return $this;
	}
	
	/**
	 * Get infomarket
	 *
	 * @return integer
	 */
	public function getInfomarket()
	{
		return $this->infomarket;
	}
	
	/**
	 * Set infoprodukt
	 *
	 * @param integer $infoprodukt
	 *
	 * @return SimpleEntityFilter
	 */
	public function setInfoprodukt($infoprodukt)
	{
		$this->infoprodukt = $infoprodukt;
	
		return $this;
	}
	
	/**
	 * Get infoprodukt
	 *
	 * @return integer
	 */
	public function getInfoprodukt()
	{
		return $this->infoprodukt;
	}
}