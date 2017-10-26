<?php

namespace AppBundle\Factory\Common\Image;

use Stof\DoctrineExtensionsBundle\Uploadable\UploadedFileInfo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadedFileInfoFactory {
	
	public function create(UploadedFile $uploadedFile) {
		return new UploadedFileInfo($uploadedFile);
	}
}