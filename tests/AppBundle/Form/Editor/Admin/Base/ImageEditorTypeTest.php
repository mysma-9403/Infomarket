<?php

namespace Tests\AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\Image;
use AppBundle\Form\Editor\Admin\Base\ImageEditorType;

class ImageEditorTypeTest extends SimpleEditorTypeTest {

	const FILE = 'Test file';

	const VERTICAL = true;

	const FORCED_WIDTH = 130;

	const FORCED_HEIGHT = 117;

	protected function assertEntity($entity) {
		/** @var Image $entity */
		$this->assertSame(self::FILE, $entity->getFile());
		$this->assertSame(self::VERTICAL, $entity->getVertical());
		$this->assertSame(self::FORCED_WIDTH, $entity->getForcedWidth());
		$this->assertSame(self::FORCED_HEIGHT, $entity->getForcedHeight());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['file'] = self::FILE;
		$data['vertical'] = self::VERTICAL;
		$data['forcedWidth'] = self::FORCED_WIDTH;
		$data['forcedHeight'] = self::FORCED_HEIGHT;
		
		return $data;
	}

	protected function getFormType() {
		return ImageEditorType::class;
	}

	protected function getEntity() {
		return new Image();
	}
}