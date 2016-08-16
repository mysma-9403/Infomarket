<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * ArticleTagAssignment
 */
class ArticleTagAssignment extends Audit
{
	public function validate(ExecutionContextInterface $context, $payload)
	{	
		if ($this->tag == null && $this->newTagName == null) {
			$context->buildViolation('tag.tagAndNameAreNull')
			->addViolation()
			;
		}
		
		if ($this->tag != null && $this->newTagName != null) {
			$context->buildViolation('tag.tagAndNameAreNotNull')
			->addViolation()
			;
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
     * @var string
     */
    private $newTagName;

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
    
    /**
     * Set newTagName
     *
     * @param string $newTagName
     *
     * @return ArticleTagAssignment
     */
    public function setNewTagName($newTagName)
    {
    	$this->newTagName = $newTagName;
    
    	return $this;
    }
    
    /**
     * Get newTagName
     *
     * @return string
     */
    public function getNewTagName()
    {
    	return $this->newTagName;
    }
}
