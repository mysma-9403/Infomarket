<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Entity\Category;

class MagazineFilter extends SimpleEntityFilter {

	/**
	 * @var CategoryRepository
	 */
	protected $categoryRepository;
	
	public function __construct(UserRepository $userRepository, CategoryRepository $categoryRepository) {
		parent::__construct($userRepository);
		
		$this->categoryRepository = $categoryRepository;
		
		$this->filterName = 'magazine_filter_';
		
		$this->featured = $this::ALL_VALUES;
		$this->infomarket = $this::ALL_VALUES;
		$this->infoprodukt = $this::ALL_VALUES;
		
		$this->orderBy = 'e.name ASC';
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
		
		$categories = $request->get($this->getFilterName() . 'categories', array());
		$this->categories = $this->categoryRepository->findBy(array('id' => $categories));
		
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
		
		$this->categories = array();
		
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
		
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
		
		if($this->featured !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'featured'] = $this->featured;
		}
		
		if($this->infomarket !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'infomarket'] = $this->infomarket;
		}
		
		if($this->infoprodukt !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'infoprodukt'] = $this->infoprodukt;
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
	
		if($this->categories) {
			$expressions[] = $this->getEqualArrayExpression('c.id', $this->categories);
		}
		
		if($this->featured !== SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.featured = ' . $this->featured;
		}
		
		if($this->infomarket !== SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.infomarket = ' . $this->infomarket;
		}
		
		if($this->infoprodukt !== SimpleEntityFilter::ALL_VALUES) {
			$expressions[] = 'e.infoprodukt = ' . $this->infoprodukt;
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
	
		if($this->categories) {
			$expressions[] = Category::class . ' c WITH c.magazine = e.id';
		}
		
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $categories;
	
	/**
	 *
	 * @var
	 */
	private $featured;
	
	/**
	 *
	 * @var
	 */
	private $infomarket;
	
	/**
	 *
	 * @var
	 */
	private $infoprodukt;
	
	/**
	 * Set categories
	 *
	 * @param array $categories
	 *
	 * @return ArticleFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
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
	
	/**
	 * Set infomarket
	 *
	 * @param boolean $infomarket
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
	 * @return boolean
	 */
	public function getInfomarket()
	{
		return $this->infomarket;
	}
	
	/**
	 * Set infoprodukt
	 *
	 * @param boolean $infoprodukt
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
	 * @return boolean
	 */
	public function getInfoprodukt()
	{
		return $this->infoprodukt;
	}
}