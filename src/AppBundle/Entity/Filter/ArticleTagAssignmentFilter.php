<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\Article;
use AppBundle\Entity\Tag;
use AppBundle\Repository\ArticleTagAssignmentRepository;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\TagRepository;
use Symfony\Component\HttpFoundation\Request;

class ArticleTagAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param ArticleTagAssignmentRepository $articleRepository
	 * @param TagRepository $tagRepository
	 */
	public function __construct(ArticleRepository $articleRepository, TagRepository $tagRepository) {
		parent::__construct();
		
		$this->articleRepository = $articleRepository;
		$this->tagRepository = $tagRepository;
		
		$this->filterName = 'article_tag_assignment_filter_';
		
		$this->orderBy = 't.name ASC, a.name ASC, a.subname ASC';
	}
	
	/**
	 * @var ArticleTagAssignmentTagRepository
	 */
	protected $articleRepository;
	
	/**
	 * @var TagRepository
	 */
	protected $tagRepository;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$articles = $request->get($this->getFilterName() . 'articles', array());
		$this->articles = $this->articleRepository->findBy(array('id' => $articles));
		
		$tags = $request->get($this->getFilterName() . 'tags', array());
		$this->tags = $this->tagRepository->findBy(array('id' => $tags));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->articles = array();
		$this->tags = array();
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
		
		if($this->tags) {
			$values[$this->getFilterName() . 'tags'] = $this->getIdValues($this->tags);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->articles) {
			$expressions[] = $this->getEqualArrayExpression('e.article', $this->articles);
		}
		
		if($this->tags) {
			$expressions[] = $this->getEqualArrayExpression('e.tag', $this->tags);
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
		$expressions[] = Tag::class . ' t WITH e.tag = t.id';
	
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
	private $tags;
	
	/**
	 * Set articles
	 *
	 * @param array $articles
	 *
	 * @return ArticleTagAssignmentFilter
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
	 * Set tags
	 *
	 * @param array $tags
	 *
	 * @return ArticleTagAssignmentFilter
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
	
		return $this;
	}
	
	/**
	 * Get article tags
	 *
	 * @return array
	 */
	public function getTags()
	{
		return $this->tags;
	}
}