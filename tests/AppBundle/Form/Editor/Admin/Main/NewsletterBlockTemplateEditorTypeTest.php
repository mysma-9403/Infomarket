<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterBlockTemplate;
use AppBundle\Form\Editor\Admin\Main\NewsletterBlockTemplateEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class NewsletterBlockTemplateEditorTypeTest extends SimpleEditorTypeTest {

	const NAME = 'Test name';

	const STYLE = 'Test style';

	const CONTENT = 'Test content';

	const ADVERT_CONTENT = 'Test advert content';

	const ARTICLE_CONTENT = 'Test article content';

	const MAGAZINE_CONTENT = 'Test magazine content';

	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var NewsletterBlockTemplate $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::STYLE, $entity->getStyle());
		
		$this->assertSame(self::CONTENT, $entity->getContent());
		$this->assertSame(self::ADVERT_CONTENT, $entity->getAdvertContent());
		$this->assertSame(self::ARTICLE_CONTENT, $entity->getArticleContent());
		$this->assertSame(self::MAGAZINE_CONTENT, $entity->getMagazineContent());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
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