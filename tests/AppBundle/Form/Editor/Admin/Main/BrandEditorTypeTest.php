<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Brand;
use AppBundle\Form\Editor\Admin\Main\BrandEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEntityEditorTypeTest;

class BrandEditorTypeTest extends ImageEntityEditorTypeTest {
	
	const WWW = 'http://krk-dev.com';
	const CONTENT = 'Test content';
	
	
	
	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var Brand $entity */
		$this->assertSame(self::WWW, $entity->getWww());
		$this->assertSame(self::CONTENT, $entity->getContent());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['www'] = self::WWW;
		$data['content'] = self::CONTENT;
		
		return $data;
	}
	
	protected function getFormType() {
		return BrandEditorType::class;
	}
	
	protected function getEntity() {
		return new Brand();
	}
}