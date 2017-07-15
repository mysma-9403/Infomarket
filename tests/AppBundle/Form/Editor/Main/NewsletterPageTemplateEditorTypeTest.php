<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Form\Editor\Main\NewsletterPageTemplateEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Base\SimpleEntityEditorTypeTest;

class NewsletterPageTemplateEditorTypeTest extends SimpleEntityEditorTypeTest {
	
	const STYLE = 'Test style';
	const CONTENT = 'Test content';
	
	
	
	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterPageTemplate $entity */
		$this->assertSame(self::STYLE, $entity->getStyle());
		$this->assertSame(self::CONTENT, $entity->getContent());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['style'] = self::STYLE;
		$data['content'] = self::CONTENT;
		
		return $data;
	}
	
	protected function getFormType() {
		return NewsletterPageTemplateEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterPageTemplate();
	}
}