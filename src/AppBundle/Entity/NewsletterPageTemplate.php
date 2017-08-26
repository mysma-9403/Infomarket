<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;
use AppBundle\Entity\Base\SimpleEntity;

class NewsletterPageTemplate extends Audit
{
	public function getDisplayName() {
		return $this->getName();
	}
	
	/**
	 * @var string
	 */
	protected $name;
	
	
	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return SimpleEntity
	 */
	public function setName($name)
	{
		$this->name = $name;
	
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
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
    /**
     * @var string
     */
    private $style;


    /**
     * Set style
     *
     * @param string $style
     *
     * @return NewsletterPageTemplate
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
}
