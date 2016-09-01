<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

class NewsletterPageTemplate extends SimpleEntity
{
	
    /**
     * @var string
     */
    private $content;


    /**
     * Set content
     *
     * @param string $content
     *
     * @return NewsletterPageTemplate
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
