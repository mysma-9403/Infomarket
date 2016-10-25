<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntity;

/**
 * Magazine
 */
class Magazine extends ImageEntity
{
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return '../web/uploads/magazines';
	}

    /**
     * @var boolean
     */
    private $featured;

    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var string
     */
    private $magazineFile;

    /**
     * @var string
     */
    private $content;


    /**
     * Set featured
     *
     * @param boolean $featured
     *
     * @return Magazine
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return Magazine
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return integer
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set magazineFile
     *
     * @param string $magazineFile
     *
     * @return Magazine
     */
    public function setMagazineFile($magazineFile)
    {
        $this->magazineFile = $magazineFile;

        return $this;
    }

    /**
     * Get magazineFile
     *
     * @return string
     */
    public function getMagazineFile()
    {
        return $this->magazineFile;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Magazine
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
     * @var boolean
     */
    private $infomarket;

    /**
     * @var boolean
     */
    private $infoprodukt;


    /**
     * Set infomarket
     *
     * @param boolean $infomarket
     *
     * @return Magazine
     */
    public function setInfomarket($infomarket)
    {
        $this->infomarket = $infomarket;

        return $this;
    }

    /**
     * Get infomarket
     *
     * @return boolean
     */
    public function getInfomarket()
    {
        return $this->infomarket;
    }

    /**
     * Set infoprodukt
     *
     * @param boolean $infoprodukt
     *
     * @return Magazine
     */
    public function setInfoprodukt($infoprodukt)
    {
        $this->infoprodukt = $infoprodukt;

        return $this;
    }

    /**
     * Get infoprodukt
     *
     * @return boolean
     */
    public function getInfoprodukt()
    {
        return $this->infoprodukt;
    }
}
