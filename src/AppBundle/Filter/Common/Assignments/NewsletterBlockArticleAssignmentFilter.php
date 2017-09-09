<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockArticleAssignmentFilter extends SimpleFilter {

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

	public function setNewsletterBlocks($newsletterBlocks) {
		$this->newsletterBlocks = $newsletterBlocks;
		
		return $this;
	}

	public function getNewsletterBlocks() {
		return $this->newsletterBlocks;
	}

	public function setArticles($articles) {
		$this->articles = $articles;
		
		return $this;
	}

	public function getArticles() {
		return $this->articles;
	}
}