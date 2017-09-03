<?php

namespace AppBundle\Entity\Other;

class ArticleTagAssignments {

	/**
	 *
	 * @var integer
	 */
	private $article;

	/**
	 *
	 * @var array
	 */
	private $tags;

	/**
	 *
	 * @var string
	 */
	private $tagsString;

	public function setArticle($article) {
		$this->article = $article;
		
		return $this;
	}

	public function getArticle() {
		return $this->article;
	}

	public function setTags($tags) {
		$this->tags = $tags;
		
		return $this;
	}

	public function getTags() {
		return $this->tags;
	}

	public function setTagsString($tagsString) {
		$this->tagsString = $tagsString;
		
		return $this;
	}

	public function getTagsString() {
		return $this->tagsString;
	}
}
