<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Page;
use AppBundle\Form\Editor\Admin\Main\PageEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEntityEditorTypeTest;

class PageEditorTypeTest extends ImageEntityEditorTypeTest {
	
	const SUBNAME = 'Test subname';
	const CONTENT = 'Test content';
	
	
	
	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var Page $entity */
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		$this->assertSame(self::CONTENT, $entity->getContent());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['subname'] = self::SUBNAME;
		$data['content'] = self::CONTENT;
		
		return $data;
	}
	
	protected function getFormType() {
		return PageEditorType::class;
	}
	
	protected function getEntity() {
		return new Page();
	}
}