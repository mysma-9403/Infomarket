<?php

namespace AppBundle\Entity\Assignments;

use AppBundle\Entity\Base\Simple;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ArticleBrandAssignment extends Simple {

	public function getDisplayName() {
		return $this->brand->getDisplayName();
	}

	public function validate(ExecutionContextInterface $context, $payload) {
		if ($this->article->getParent()) {
			$context->buildViolation('articleBrandAssignment.subarticle')->atPath('article')->addViolation();
		}
	}

	/**
	 *
	 * @var \AppBundle\Entity\Main\Article
	 */
	private $article;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Brand
	 */
	private $brand;

	/**
	 * Set article
	 *
	 * @param \AppBundle\Entity\Main\Article $article        	
	 *
	 * @return ArticleBrandAssignment
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
	 * Set brand
	 *
	 * @param \AppBundle\Entity\Main\Brand $brand        	
	 *
	 * @return ArticleBrandAssignment
	 */
	public function setBrand(\AppBundle\Entity\Main\Brand $brand = null) {
		$this->brand = $brand;
		
		return $this;
	}

	/**
	 * Get brand
	 *
	 * @return \AppBundle\Entity\Main\Brand
	 */
	public function getBrand() {
		return $this->brand;
	}
}
