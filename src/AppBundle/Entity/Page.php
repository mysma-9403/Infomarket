<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Page
 */
class Page extends ImageEntity
{	
	public function getDisplayName() {
		$result = parent::getDisplayName();
		if($this->subname) {
			if($result == '<empty>')
				$result = $this->subname;
				else
					$result .= ' ' . $this->subname;
		}
	
		return $result;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return 'uploads/pages';
	}
	
    /**
     * @var string
     */
    private $subname;

    /**
     * @var string
     */
    private $content;


    /**
     * Set subname
     *
     * @param string $subname
     *
     * @return Page
     */
    public function setSubname($subname)
    {
        $this->subname = $subname;

        return $this;
    }

    /**
     * Get subname
     *
     * @return string
     */
    public function getSubname()
    {
        return $this->subname;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Page
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
