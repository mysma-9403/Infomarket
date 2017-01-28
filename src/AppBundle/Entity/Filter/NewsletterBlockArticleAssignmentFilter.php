<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\NewsletterBlockArticleAssignmentRepository;
use AppBundle\Repository\NewsletterBlockRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockArticleAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param NewsletterBlockArticleAssignmentRepository $newsletterBlockRepository
	 * @param ArticleRepository $articleRepository
	 */
	public function __construct(UserRepository $userRepository, NewsletterBlockRepository $newsletterBlockRepository, ArticleRepository $articleRepository) {
		parent::__construct($userRepository);
		
		$this->newsletterBlockRepository = $newsletterBlockRepository;
		$this->articleRepository = $articleRepository;
		
		$this->filterName = 'newsletter_block_article_assignment_filter_';
		
		$this->orderBy = 'a.name ASC, nb.name';
	}
	
	/**
	 * @var NewsletterBlockArticleAssignmentArticleRepository
	 */
	protected $newsletterBlockRepository;
	
	/**
	 * @var ArticleRepository
	 */
	protected $articleRepository;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$newsletterBlocks = $request->get($this->getFilterName() . 'newsletterBlocks', array());
		$this->newsletterBlocks = $this->newsletterBlockRepository->findBy(array('id' => $newsletterBlocks));
		
		$articles = $request->get($this->getFilterName() . 'articles', array());
		$this->articles = $this->articleRepository->findBy(array('id' => $articles));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->newsletterBlocks = array();
		$this->articles = array();
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
		
		if($this->articles) {
			$values[$this->getFilterName() . 'articles'] = $this->getIdValues($this->articles);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->newsletterBlocks) {
			$expressions[] = $this->getEqualArrayExpression('e.newsletterBlock', $this->newsletterBlocks);
		}
		
		if($this->articles) {
			$expressions[] = $this->getEqualArrayExpression('e.article', $this->articles);
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
		$expressions[] = Article::class . ' a WITH e.article = a.id';
	
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
	private $articles;
	
	/**
	 * Set newsletterBlocks
	 *
	 * @param array $newsletterBlocks
	 *
	 * @return NewsletterBlockArticleAssignmentFilter
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
	 * Set articles
	 *
	 * @param array $articles
	 *
	 * @return NewsletterBlockArticleAssignmentFilter
	 */
	public function setArticles($articles)
	{
		$this->articles = $articles;
	
		return $this;
	}
	
	/**
	 * Get newsletterBlock articles
	 *
	 * @return array
	 */
	public function getArticles()
	{
		return $this->articles;
	}
}