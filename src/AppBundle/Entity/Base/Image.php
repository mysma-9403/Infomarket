<?php

namespace AppBundle\Entity\Base;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image extends Audit {
	
	public function getUploadPath()
	{
		return '../web/upload/images';
	}
	
	public function getImagePath()
	{
		if($this->image === null) return null;
		return str_replace('../web/', '', $this->image);
		
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
     * Set file
     *
     * @param UploadedFile $file
     *
     * @return Image
     */
    public function setFile($file)
    {
    	$this->file= $file;
    
    	return $this;
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
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
     * Set image path
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
     * Get image path
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
