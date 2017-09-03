<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Term;
use AppBundle\Form\Editor\Admin\Main\TermEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class TermEditorTypeTest extends SimpleEditorTypeTest {
	
	const CONTENT = 'Test content';
	
	
	
	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var Term $entity */
		$this->assertSame(self::CONTENT, $entity->getContent());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['content'] = self::CONTENT;
		
		return $data;
	}
	
	protected function getFormType() {
		return TermEditorType::class;
	}
	
	protected function getEntity() {
		return new Term();
	}
}