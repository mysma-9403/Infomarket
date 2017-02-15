<?php

namespace AppBundle\Filter\Admin\Assignments;

use AppBundle;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Filter\Admin\Base\AuditFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockArticleAssignmentFilter extends AuditFilter {
	
	/**
	 *
	 * @var array
	 */
	protected $newsletterBlocks = array();
	
	/**
	 *
	 * @var array
	 */
	protected $articles = array();
	
	
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
	
		$this->newsletterBlocks = $this->getRequestArray($request, 'newsletter_blocks');
		$this->articles = $this->getRequestArray($request, 'articles');
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->newsletterBlocks = array();
		$this->articles = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		$this->setRequestArray($values, 'newsletter_blocks', $this->newsletterBlocks);
		$this->setRequestArray($values, 'articles', $this->articles);
		
		return $values;
	}
	
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