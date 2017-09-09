<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterPageTemplate;
use AppBundle\Form\Editor\Admin\Main\NewsletterPageTemplateEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class NewsletterPageTemplateEditorTypeTest extends SimpleEditorTypeTest {

	const NAME = 'Test name';

	const STYLE = 'Test style';

	const CONTENT = 'Test content';

	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var NewsletterPageTemplate $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::STYLE, $entity->getStyle());
		$this->assertSame(self::CONTENT, $entity->getContent());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
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