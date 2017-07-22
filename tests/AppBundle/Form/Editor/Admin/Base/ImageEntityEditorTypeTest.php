<?php

namespace Tests\AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\ImageEntity;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;

class ImageEntityEditorTypeTest extends SimpleEntityEditorTypeTest {
	
	const FILE = 'Test file';
	const VERTICAL = true;
	const FORCED_WIDTH = 130;
	const FORCED_HEIGHT = 117;
	
	protected function assertEntity($entity) {
		/** @var ImageEntity $entity */
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
		return ImageEntityEditorType::class;
	}
	
	protected function getEntity() {
		return new ImageEntity();
	}
}