<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * ArticleBrandAssignment
 */
class ArticleBrandAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->brand->getDisplayName();
	}
	
	/**
	 *
	 * @param ExecutionContextInterface $context
	 * @param unknown $payload
	 */
	public function validate(ExecutionContextInterface $context, $payload)
	{
		if ($this->article->getParent()) {
			$context->buildViolation('articleBrandAssignment.subarticle')
			->atPath('article')
			->addViolation();
		}
	}
	
    /**
     * @var \AppBundle\Entity\Article
     */
    private $article;

    /**
     * @var \AppBundle\Entity\Brand
     */
    private $brand;


    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return ArticleBrandAssignment
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set brand
     *
     * @param \AppBundle\Entity\Brand $brand
     *
     * @return ArticleBrandAssignment
     */
    public function setBrand(\AppBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \AppBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
}
