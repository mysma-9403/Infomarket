<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ArticleCategoryAssignment extends Simple {

	public function getDisplayName() {
		return $this->category->getDisplayName();
	}

	public function validate(ExecutionContextInterface $context, $payload) {
		if ($this->article->getParent()) {
			$context->buildViolation('articleCategoryAssignment.subarticle')->atPath('article')->addViolation();
		}
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\Article
	 */
	private $article;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 * Set article
	 *
	 * @param \AppBundle\Entity\Main\Article $article        	
	 *
	 * @return ArticleCategoryAssignment
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
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return ArticleCategoryAssignment
	 */
	public function setCategory(\AppBundle\Entity\Main\Category $category = null) {
		$this->category = $category;
		
		return $this;
	}

	/**
	 * Get category
	 *
	 * @return \AppBundle\Entity\Main\Category
	 */
	public function getCategory() {
		return $this->category;
	}
}
