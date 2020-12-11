<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ArticleArticleCategoryAssignment extends Simple {

	public function getDisplayName() {
		return $this->articleCategory->getDisplayName();
	}

	public function validate(ExecutionContextInterface $context, $payload) {
		if ($this->article->getParent()) {
			$context->buildViolation('articleArticleCategoryAssignment.subarticle')->atPath('article')->addViolation();
		}
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\Article
	 */
	private $article;

	/**
	 *
	 * @var \AppBundle\Entity\Main\ArticleCategory
	 */
	private $articleCategory;

	/**
	 * Set article
	 *
	 * @param \AppBundle\Entity\Main\Article $article        	
	 *
	 * @return ArticleArticleCategoryAssignment
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
	 * Set articleCategory
	 *
	 * @param \AppBundle\Entity\Main\ArticleCategory $articleCategory        	
	 *
	 * @return ArticleArticleCategoryAssignment
	 */
	public function setArticleCategory(\AppBundle\Entity\Main\ArticleCategory $articleCategory = null) {
		$this->articleCategory = $articleCategory;
		
		return $this;
	}

	/**
	 * Get articleCategory
	 *
	 * @return \AppBundle\Entity\Main\ArticleCategory
	 */
	public function getArticleCategory() {
		return $this->articleCategory;
	}
}
