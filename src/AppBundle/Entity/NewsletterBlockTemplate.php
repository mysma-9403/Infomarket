<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

class NewsletterBlockTemplate extends SimpleEntity
{
	
    /**
     * @var string
     */
    private $style;

    /**
     * @var string
     */
    private $content;


    /**
     * Set style
     *
     * @param string $style
     *
     * @return NewsletterBlockTemplate
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return NewsletterBlockTemplate
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
