<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Brand;
use AppBundle\Repository\ArticleBrandAssignmentRepository;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\BrandRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class ArticleBrandAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param ArticleBrandAssignmentRepository $articleRepository
	 * @param BrandRepository $brandRepository
	 */
	public function __construct(
			UserRepository $userRepository, 
			ArticleRepository $articleRepository, 
			BrandRepository $brandRepository) {
		
		parent::__construct($userRepository);
		
		$this->articleRepository = $articleRepository;
		$this->brandRepository = $brandRepository;
		
		$this->filterName = 'article_brand_assignment_filter_';
		
		$this->orderBy = 'b.name ASC, a.name ASC, a.subname ASC';
	}
	
	/**
	 * @var ArticleBrandAssignmentBrandRepository
	 */
	protected $articleRepository;
	
	/**
	 * @var BrandRepository
	 */
	protected $brandRepository;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$articles = $request->get($this->getFilterName() . 'articles', array());
		$this->articles = $this->articleRepository->findBy(array('id' => $articles));
		
		$brands = $request->get($this->getFilterName() . 'brands', array());
		$this->brands = $this->brandRepository->findBy(array('id' => $brands));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->articles = array();
		$this->brands = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->articles) {
			$values[$this->getFilterName() . 'articles'] = $this->getIdValues($this->articles);
		}
		
		if($this->brands) {
			$values[$this->getFilterName() . 'brands'] = $this->getIdValues($this->brands);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->articles) {
			$expressions[] = $this->getEqualArrayExpression('e.article', $this->articles);
		}
		
		if($this->brands) {
			$expressions[] = $this->getEqualArrayExpression('e.brand', $this->brands);
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
		
		$expressions[] = Article::class . ' a WITH e.article = a.id';
		$expressions[] = Brand::class . ' b WITH e.brand = b.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $articles;
	
	/**
	 *
	 * @var array
	 */
	private $brands;
	
	/**
	 * Set articles
	 *
	 * @param array $articles
	 *
	 * @return ArticleBrandAssignmentFilter
	 */
	public function setArticles($articles)
	{
		$this->articles = $articles;
	
		return $this;
	}
	
	/**
	 * Get articles
	 *
	 * @return array
	 */
	public function getArticles()
	{
		return $this->articles;
	}
	
	/**
	 * Set brands
	 *
	 * @param array $brands
	 *
	 * @return ArticleBrandAssignmentFilter
	 */
	public function setBrands($brands)
	{
		$this->brands = $brands;
	
		return $this;
	}
	
	/**
	 * Get article brands
	 *
	 * @return array
	 */
	public function getBrands()
	{
		return $this->brands;
	}
}