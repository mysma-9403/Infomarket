<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

class Segment extends ImageEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/segments';
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
     * @return Segment
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
