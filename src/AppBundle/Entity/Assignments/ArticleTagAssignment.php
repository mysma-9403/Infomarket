<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ArticleTagAssignment extends Simple {

	public function getDisplayName() {
		return $this->tag->getDisplayName();
	}

	public function validate(ExecutionContextInterface $context, $payload) {
		if ($this->article->getParent()) {
			$context->buildViolation('articleTagAssignment.subarticle')->atPath('article')->addViolation();
		}
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\Article
	 */
	private $article;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Tag
	 */
	private $tag;

	/**
	 * Set article
	 *
	 * @param \AppBundle\Entity\Main\Article $article        	
	 *
	 * @return ArticleTagAssignment
	 */
	public function setArticle(\AppBundle\Entity\Main\Article $article = null) {
		$this->article = $article;
		
		return $this;
	}

	/**
	 * Get article
	 *
	 * @return \AppBundle\Entity\Main\Article
	 */
	public function getArticle() {
		return $this->article;
	}

	/**
	 * Set tag
	 *
	 * @param \AppBundle\Entity\Main\Tag $tag        	
	 *
	 * @return ArticleTagAssignment
	 */
	public function setTag(\AppBundle\Entity\Main\Tag $tag = null) {
		$this->tag = $tag;
		
		return $this;
	}

	/**
	 * Get tag
	 *
	 * @return \AppBundle\Entity\Main\Tag
	 */
	public function getTag() {
		return $this->tag;
	}
}
