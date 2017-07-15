<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Form\Editor\Main\NewsletterBlockTemplateEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Base\SimpleEntityEditorTypeTest;

class NewsletterBlockTemplateEditorTypeTest extends SimpleEntityEditorTypeTest {
	
	const STYLE = 'Test style';
	const CONTENT = 'Test content';
	const ADVERT_CONTENT = 'Test advert content';
	const ARTICLE_CONTENT = 'Test article content';
	const MAGAZINE_CONTENT = 'Test magazine content';
	
	
	
	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterBlockTemplate $entity */
		$this->assertSame(self::STYLE, $entity->getStyle());
		$this->assertSame(self::CONTENT, $entity->getContent());
		$this->assertSame(self::ADVERT_CONTENT, $entity->getAdvertContent());
		$this->assertSame(self::ARTICLE_CONTENT, $entity->getArticleContent());
		$this->assertSame(self::MAGAZINE_CONTENT, $entity->getMagazineContent());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['style'] = self::STYLE;
		$data['content'] = self::CONTENT;
		$data['advertContent'] = self::ADVERT_CONTENT;
		$data['articleContent'] = self::ARTICLE_CONTENT;
		$data['magazineContent'] = self::MAGAZINE_CONTENT;
		
		return $data;
	}
	
	protected function getFormType() {
		return NewsletterBlockTemplateEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterBlockTemplate();
	}
}