<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * ArticleTagAssignment
 */
class ArticleTagAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->tag->getDisplayName();
	}
	
	/**
	 *
	 * @param ExecutionContextInterface $context
	 * @param unknown $payload
	 */
	public function validate(ExecutionContextInterface $context, $payload)
	{	
		if ($this->article->getParent()) {
			$context->buildViolation('articleTagAssignment.subarticle')
			->atPath('article')
			->addViolation();
		}
	}
	
    /**
     * @var \AppBundle\Entity\Article
     */
    private $article;

    /**
     * @var \AppBundle\Entity\Tag
     */
    private $tag;

    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return ArticleTagAssignment
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
     * Set tag
     *
     * @param \AppBundle\Entity\Tag $tag
     *
     * @return ArticleTagAssignment
     */
    public function setTag(\AppBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \AppBundle\Entity\Tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}
