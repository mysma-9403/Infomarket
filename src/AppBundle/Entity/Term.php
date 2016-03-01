<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\SimpleEntity;

/**
 * Branch
 */
class Term extends SimpleEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/terms';
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
     * @return Branch
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
