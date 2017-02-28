<?php

namespace AppBundle\Entity\Other;



/**
 * ArticleTagAssignments
 */
class ArticleTagAssignments
{
    /**
     * @var integer
     */
    private $article;
    
    /**
     * @var array
     */
    private $tags;
    
    /**
     * @var string
     */
    private $tagsString;

    /**
     * Set article
     *
     * @param integer $article
     *
     * @return ArticleTagAssignments
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return integer
     */
    public function getArticle()
    {
        return $this->article;
    }
    
    /**
     * Set tags
     *
     * @param array $tags
     *
     * @return ArticleTagAssignments
     */
    public function setTags($tags)
    {
    	$this->tags = $tags;
    
    	return $this;
    }
    
    /**
     * Get tags
     *
     * @return array
     */
    public function getTags()
    {
    	return $this->tags;
    }
    
    /**
     * Set tagsString
     *
     * @param string $tagsString
     *
     * @return ArticleTagAssignments
     */
    public function setTagsString($tagsString)
    {
    	$this->tagsString = $tagsString;
    
    	return $this;
    }
    
    /**
     * Get tagsString
     *
     * @return string
     */
    public function getTagsString()
    {
    	return $this->tagsString;
    }
}
