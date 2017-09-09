<?php

namespace AppBundle\Filter\Common\Assignments;

use AppBundle;
use AppBundle\Filter\Common\Base\SimpleFilter;
use Symfony\Component\HttpFoundation\Request;

class ArticleTagAssignmentFilter extends SimpleFilter {

	/**
	 *
	 * @var array
	 */
	protected $articles = array();

	/**
	 *
	 * @var array
	 */
	protected $tags = array();

	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$this->articles = $this->getRequestArray($request, 'articles');
		$this->tags = $this->getRequestArray($request, 'tags');
	}

	public function clearRequestValues() {
		parent::clearRequestValues();
		
		$this->articles = array();
		$this->tags = array();
	}

	public function getRequestValues() {
		$values = parent::getRequestValues();
		
		$this->setRequestArray($values, 'articles', $this->articles);
		$this->setRequestArray($values, 'tags', $this->tags);
		
		return $values;
	}

	public function setArticles($articles) {
		$this->articles = $articles;
		
		return $this;
	}

	public function getArticles() {
		return $this->articles;
	}

	public function setTags($tags) {
		$this->tags = $tags;
		
		return $this;
	}

	public function getTags() {
		return $this->tags;
	}
}