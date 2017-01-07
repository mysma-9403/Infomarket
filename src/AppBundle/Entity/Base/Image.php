<?php

namespace AppBundle\Entity\Base;



class Image extends Simple {
	
	public function __construct() {
		parent::__construct();
		
		$this->vertical = false;
	}
	
	public function getUploadPath()
	{
		return '../web/upload/images/';
	}
	
	public function getImagePath()
	{
		if($this->image === null) return null;
		return str_replace('../web/', '', $this->image);
		
	}
	
	public function removeImage() {
		$this->file = null;
		$this->image = null;
		$this->mimeType = null;
		$this->size = 0;
		$this->vertical = false;
	}
	
	/**
	 * @var UploadedFile
	 */
	protected $file;
	
    /**
     * @var string
     */
    protected $mimeType;

    /**
     * @var string
     */
    protected $size;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var boolean
     */
    protected $vertical;

    /**
     * @var integer
     */
    protected $forcedWidth;

    /**
     * @var integer
     */
    protected $forcedHeight;


    /**
     * Set file
     *
     * @param UploadedFile $file
     *
     * @return Image
     * @var integer
     */
    public function setFile($file)
    {
    	$this->file = $file;
    
    	return $this;
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     * @var integer
     */
    public function getFile()
    {
    	return $this->file;
    }
    
    /**
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return Image
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return Image
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set vertical
     *
     * @param boolean $vertical
     *
     * @return Image
     */
    public function setVertical($vertical)
    {
        $this->vertical = $vertical;

        return $this;
    }

    /**
     * Get vertical
     *
     * @return boolean
     */
    public function getVertical()
    {
        return $this->vertical;
    }

    /**
     * Set forcedWidth
     *
     * @param integer $forcedWidth
     *
     * @return Image
     */
    public function setForcedWidth($forcedWidth)
    {
        $this->forcedWidth = $forcedWidth;

        return $this;
    }

    /**
     * Get forcedWidth
     *
     * @return integer
     */
    public function getForcedWidth()
    {
        return $this->forcedWidth;
    }

    /**
     * Set forcedHeight
     *
     * @param integer $forcedHeight
     *
     * @return Image
     */
    public function setForcedHeight($forcedHeight)
    {
        $this->forcedHeight = $forcedHeight;

        return $this;
    }

    /**
     * Get forcedHeight
     *
     * @return integer
     */
    public function getForcedHeight()
    {
        return $this->forcedHeight;
    }
}
