<?php

namespace AppBundle\Manager\Decorator\Common\Base;

use AppBundle\Manager\Decorator\Base\ItemDecorator;
use AppBundle\Entity\Base\Image;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use AppBundle\Factory\Common\Image\UploadedFileInfoFactory;

class ImageDecorator extends ItemDecorator {

	/**
	 *
	 * @var UploadableManager
	 */
	protected $uploadableManager;

	/**
	 *
	 * @var UploadedFileInfoFactory
	 */
	protected $uploadedFileInfoFactory;

	public function __construct(UploadableManager $uploadableManager, 
			UploadedFileInfoFactory $uploadedFileInfoFactory) {
		$this->uploadableManager = $uploadableManager;
		$this->uploadedFileInfoFactory = $uploadedFileInfoFactory;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Decorator\Base\ItemDecorator::getPrepared()
	 *
	 * @param Image $item        	
	 */
	public function getPrepared($item) {
		if ($item->getFile()) {
			$uploadedFileInfo = $this->uploadedFileInfoFactory->create($item->getFile());
			$this->uploadableManager->markEntityToUpload($item, $uploadedFileInfo);
		}
		return $item;
	}
}