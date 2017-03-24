<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * ArticleCategoryAssignment
 */
class ArticleCategoryAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->category->getDisplayName();
	}
	
	/**
	 *
	 * @param ExecutionContextInterface $context
	 * @param unknown $payload
	 */
	public function validate(ExecutionContextInterface $context, $payload)
	{
		if ($this->article->getParent()) {
			$context->buildViolation('articleCategoryAssignment.subarticle')
			->atPath('article')
			->addViolation();
		}
	}
	
    /**
     * @var \AppBundle\Entity\Article
     */
    private $article;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return ArticleCategoryAssignment
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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return ArticleCategoryAssignment
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
